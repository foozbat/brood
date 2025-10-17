# Start from the official FrankenPHP image
FROM dunglas/frankenphp:1.9-php8.4-alpine AS build

# Install PHP Redis extension
RUN install-php-extensions \
	pdo_mysql \
    redis

# Update the package lists and install git
RUN apk update && apk add --no-cache git

# Install Composer globally
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Add Composer to the PATH
#ENV PATH="$PATH:/usr/local/bin"

FROM build

COPY . /app/public
WORKDIR /app/public
RUN composer install  --no-interaction --no-progress --prefer-dist
WORKDIR /app