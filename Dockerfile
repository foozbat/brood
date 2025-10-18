# Start from the official FrankenPHP image
FROM dunglas/frankenphp:1.9-php8.4-alpine AS build

# Install PHP Redis extension
RUN install-php-extensions \
	pdo_mysql \
    redis