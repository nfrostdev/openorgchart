FROM php:7.4.3-cli AS build
# Zip and Git are required for composer dependencies.
RUN apt-get update && apt-get install zip git -y
# Install composer dependencies with Composer's docker image.
COPY --from=composer /usr/bin/composer /usr/bin/composer
# Copy the application and install dependencies.
WORKDIR /app
COPY . /app
RUN composer install --optimize-autoloader

FROM php:7.4.3-apache AS runtime
WORKDIR /var/www
# Copy the application and its dependencies to the web server container.
COPY --from=build /app /var/www
COPY --from=build /app/public /var/www/html
# Install MYSQL, enable mod rewrite, and let Apache have ownership of the required Laravel directories.
RUN docker-php-ext-install pdo_mysql && a2enmod rewrite \
  && chown -R root:www-data storage/ && chown -R root:www-data bootstrap/cache/ \
  && chmod -R 775 storage/ && chmod -R 775 bootstrap/cache/
EXPOSE 80
