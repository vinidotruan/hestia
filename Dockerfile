FROM php:8.1-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    nodejs \
    npm \
    nginx

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www

# Copy existing application directory contents
COPY . /var/www

# Install PHP dependencies
RUN composer install --optimize-autoloader --no-dev

# Install and build Angular app
WORKDIR /var/www/resources/frontend/client
RUN npm install
RUN npm run build -- --production

# Set back the working directory
WORKDIR /var/www

RUN chown -R www-data:www-data /var/www
RUN chmod -R 775 /var/www/storage /var/www/bootstrap/cache

# Copy Nginx configuration
COPY ./nginx/conf.d/app.conf /etc/nginx/sites-available/default
COPY zz-docker.conf /usr/local/etc/php-fpm.d/zz-docker.conf

# Expose port 80
EXPOSE 80

# Start Nginx and PHP-FPM
CMD php-fpm && nginx -g 'daemon off;'
