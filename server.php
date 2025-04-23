<?php

$host = '127.0.0.1';
$port = 8080;
$docRoot = realpath(__DIR__ . '/public');
$indexFile = 'index.php';

$server = stream_socket_server("tcp://$host:$port", $errno, $errstr);
if (!$server) {
    die("Error: $errstr ($errno)\n");
}
stream_set_blocking($server, false);

echo "🚀 Production PHP Server running at http://$host:$port\n";

$clients = [];

function statusMessage(int $code): string {
    return [
        200 => 'OK',
        400 => 'Bad Request',
        403 => 'Forbidden',
        404 => 'Not Found',
        405 => 'Method Not Allowed',
        500 => 'Internal Server Error',
    ][$code] ?? 'Unknown';
}

function respond($client, int $code, string $body = '', array $headers = []) {
    $statusText = statusMessage($code);
    $headers['Content-Length'] = strlen($body);
    $headers['Connection'] = 'close';
    $response = "HTTP/1.1 $code $statusText\r\n";
    foreach ($headers as $key => $val) {
        $response .= "$key: $val\r\n";
    }
    $response .= "\r\n$body";
    fwrite($client, $response);
    fclose($client);
}

function parseRequest(string $raw) {
    [$head, $body] = explode("\r\n\r\n", $raw, 2) + ['', ''];
    $lines = explode("\r\n", $head);
    $requestLine = array_shift($lines);

    if (!preg_match('#^(GET|POST|PUT|DELETE|HEAD|OPTIONS) (.*?) HTTP/1\.[01]$#', $requestLine, $m)) {
        return false;
    }

    [$method, $uri] = [$m[1], $m[2]];
    $headers = [];
    foreach ($lines as $line) {
        if (strpos($line, ':') === false) continue;
        [$k, $v] = explode(':', $line, 2);
        $headers[trim(strtoupper(str_replace('-', '_', $k)))] = trim($v);
    }

    return [
        'method' => $method,
        'uri' => $uri,
        'headers' => $headers,
        'body' => $body
    ];
}

function handleStaticFile($client, $path) {
    if (!file_exists($path) || is_dir($path)) {
        respond($client, 404, "404 Not Found");
        return true;
    }

    $lastModified = gmdate('D, d M Y H:i:s', filemtime($path)) . ' GMT';
    $content = file_get_contents($path);
    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $mime = finfo_file($finfo, $path);
    finfo_close($finfo);

    respond($client, 200, $content, [
        'Content-Type' => $mime,
        'Last-Modified' => $lastModified,
        'Cache-Control' => 'public, max-age=86400'
    ]);
    return true;
}

while (true) {
    $read = $clients;
    $read[] = $server;
    $write = $except = null;

    if (stream_select($read, $write, $except, 0, 200000)) {
        if (in_array($server, $read)) {
            $client = stream_socket_accept($server, 0);
            if ($client) {
                stream_set_blocking($client, true);
                $clients[] = $client;
            }
            unset($read[array_search($server, $read)]);
        }

        foreach ($read as $client) {
            $data = fread($client, 65535);
            if (!$data) {
                fclose($client);
                $clients = array_filter($clients, fn($c) => $c !== $client);
                continue;
            }

            $request = parseRequest($data);
            if (!$request) {
                respond($client, 400, "400 Bad Request");
                continue;
            }

            $parsedUrl = parse_url($request['uri']);
            $path = $parsedUrl['path'] ?? '/';
            $query = $parsedUrl['query'] ?? '';

            $localPath = realpath($docRoot . $path);
            if ($localPath === false || !str_starts_with($localPath, $docRoot)) {
                respond($client, 403, "403 Forbidden");
                continue;
            }

            parse_str($query, $_GET);
            $_POST = [];
            $_FILES = [];
            $_REQUEST = $_GET;

            $_SERVER = [
                'REQUEST_METHOD' => $request['method'],
                'REQUEST_URI' => $request['uri'],
                'QUERY_STRING' => $query,
                'SCRIPT_NAME' => $path,
                'REMOTE_ADDR' => '127.0.0.1',
                'SERVER_PROTOCOL' => 'HTTP/1.1',
                'CONTENT_LENGTH' => $request['headers']['CONTENT_LENGTH'] ?? strlen($request['body']),
                'CONTENT_TYPE' => $request['headers']['CONTENT_TYPE'] ?? '',
                'HTTP_HOST' => $request['headers']['HOST'] ?? 'localhost',
            ];

            foreach ($request['headers'] as $k => $v) {
                if (!isset($_SERVER["HTTP_$k"])) {
                    $_SERVER["HTTP_$k"] = $v;
                }
            }

            if ($_SERVER['REQUEST_METHOD'] === 'POST' &&
                strpos($_SERVER['CONTENT_TYPE'], 'application/x-www-form-urlencoded') !== false) {
                parse_str($request['body'], $_POST);
                $_REQUEST = array_merge($_GET, $_POST);
            }

            // Serve file if it exists
            if (handleStaticFile($client, $localPath)) {
                continue;
            }

            // Otherwise run PHP
            if (file_exists("$docRoot/$indexFile")) {
                ob_start();
                chdir($docRoot);
                include "$docRoot/$indexFile";
                $output = ob_get_clean();
                respond($client, 200, $output, ['Content-Type' => 'text/html']);
            } else {
                respond($client, 500, "500 Internal Server Error — No $indexFile");
            }

            // Log the request
            $log = sprintf(
                "[%s] \"%s %s\" %s",
                date('Y-m-d H:i:s'),
                $request['method'],
                $request['uri'],
                $_SERVER['REMOTE_ADDR']
            );
            echo $log . "\n";

            $clients = array_filter($clients, fn($c) => $c !== $client);
        }
    }

    usleep(10000);
}
