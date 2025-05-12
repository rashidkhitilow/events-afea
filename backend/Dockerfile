FROM php:8.2-fpm

# Install curl extension first

# Copy composer from official image
COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

# Set working directory
WORKDIR /var/www/html/
RUN apt-get update && apt-get install -y ca-certificates

# Configure PHP-FPM to run as root (not recommended for production)
RUN sed -i "s/user = www-data/user = root/g" /usr/local/etc/php-fpm.d/www.conf && \
    sed -i "s/group = www-data/group = root/g" /usr/local/etc/php-fpm.d/www.conf && \
    echo "php_admin_flag[log_errors] = on" >> /usr/local/etc/php-fpm.d/www.conf

# Install PHP extensions
RUN docker-php-ext-install pdo pdo_mysql

# Copy application files
COPY . /var/www/html

# Fix permissions (still assigned to www-data user for Laravel's needs)
RUN chown -R www-data:www-data \
    /var/www/html/storage \
    /var/www/html/bootstrap/cache

# Expose PHP-FPM port
EXPOSE 9000

# Start PHP-FPM
CMD ["php-fpm", "-y", "/usr/local/etc/php-fpm.conf", "-R"]
