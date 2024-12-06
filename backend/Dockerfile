# Use an official PHP image
FROM php:8.2-fpm

# Set working directory
WORKDIR /usr/src/app

# Install dependencies
RUN apt-get update && apt-get install -y \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libmcrypt-dev \
    libpng-dev \
    zlib1g-dev \
    libxml2-dev \
    libzip-dev \
    libonig-dev \
    graphviz \
    git \
    curl \
    zip \
    unzip \

    && docker-php-ext-configure gd \
    && docker-php-ext-install -j$(nproc) gd \
    && docker-php-ext-install zip \
    && docker-php-source delete \
    && curl -sS https://getcomposer.org/installer | php -- \
    --install-dir=/usr/local/bin --filename=composer

# Install PHP extensions
RUN docker-php-ext-install mbstring exif pcntl bcmath gd

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy existing application code
COPY . .

# Install Composer dependencies
RUN composer install --no-dev --optimize-autoloader

# Set permissions
RUN chown -R www-data:www-data /usr/src/app

# Expose port 8000
EXPOSE 8000

# Start PHP FPM server
CMD ["php", "-S", "0.0.0.0:8000", "-t", "public"]
