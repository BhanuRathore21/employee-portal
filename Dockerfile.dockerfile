# Use the same php version with Apache
FROM php:8.2-apache

# Set working directory
WORKDIR /var/www/html

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev \
    && docker-php-ext-install zip pdo_mysql

# Enable Apache modules
RUN a2enmod rewrite

# Install Composer globally
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copy Laravel application files
COPY . /var/www/html

# Set permissions
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Install PHP dependencies
RUN composer install --no-scripts --no-autoloader

# Generate optimized autoload files
RUN composer dump-autoload --no-scripts --optimize

# Expose port 80 (default for Apache)
EXPOSE 80

# Set ownership and permissions for Laravel application
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
RUN chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Update Apache default virtual host configuration
RUN sed -i 's/DocumentRoot \/var\/www\/html/DocumentRoot \/var\/www\/html\n\t<Directory \/var\/www\/html>\n\t\tOptions Indexes FollowSymLinks\n\t\tAllowOverride All\n\t\tRequire all granted\n\t<\/Directory>/' /etc/apache2/sites-available/000-default.conf

# Start Apache service
CMD ["apache2-foreground"]
