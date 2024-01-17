FROM php:8.1-apache

# Install dependencies
RUN apt-get update && \
    apt-get install -y \
        libzip-dev \
        zip

# Enable Apache modules
RUN a2enmod rewrite

RUN docker-php-ext-install mysqli

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Set the working directory
WORKDIR /var/www/html

# Copy application files
COPY . /var/www/html

# Install PHP dependencies using Composer
RUN composer install --no-scripts --no-autoloader

# Run Composer scripts and set permissions
RUN composer dump-autoload --optimize && \
    chown -R www-data:www-data /var/www/html

# Expose port
EXPOSE 80

# Start Apache
CMD ["apache2-foreground"]
