# Start from the official FrankenPHP image
FROM dunglas/frankenphp AS build

# Install PHP Redis extension
RUN install-php-extensions \
	pdo_mysql \
    redis \
    sockets