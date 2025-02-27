# Use official PHP-Apache image
FROM php:8.1-apache

# Set working directory
WORKDIR /var/www/html

# Install required system dependencies
RUN apt-get update && apt-get install -y \
    libpng-dev \
    zip \
    unzip \
    git \
    curl

# Install PHP extensions
RUN docker-php-ext-install pdo pdo_mysql gd

# Enable Apache rewrite module
RUN a2enmod rewrite

# Install Composer globally
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copy Laravel project files
COPY . .

# Copy Apache config file
COPY apache/laravel.conf /etc/apache2/sites-available/000-default.conf

# Set correct permissions
RUN chmod -R 775 storage bootstrap/cache

# Expose Apache port
EXPOSE 80

# Start Apache server
CMD ["apache2-foreground"]
