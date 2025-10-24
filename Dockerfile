# ========================================
# Multi-Stage Dockerfile for Laravel 12
# UrbanGreen Production Build
# ========================================

# ========================================
# Stage 1: Builder Stage
# ========================================
FROM php:8.3.6-fpm-alpine AS builder

# Set working directory
WORKDIR /var/www/html

# Install system dependencies and PHP extensions
RUN apk add --no-cache \
    $PHPIZE_DEPS \
    # Required libraries
    curl \
    libzip-dev \
    zip \
    unzip \
    oniguruma-dev \
    libpng-dev \
    libjpeg-turbo-dev \
    freetype-dev \
    icu-dev \
    # PDF processing dependencies
    poppler-utils \
    ghostscript \
    imagemagick \
    imagemagick-dev \
    # Database extensions
    mysql-client \
    # Redis support
    && pecl install redis \
    && docker-php-ext-enable redis \
    # Install imagick for PDF manipulation
    && pecl install imagick \
    && docker-php-ext-enable imagick \
    # Install PHP extensions
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) \
        pdo_mysql \
        mbstring \
        exif \
        pcntl \
        bcmath \
        gd \
        zip \
        intl \
        opcache \
    # Clean up build dependencies to reduce image size
    && apk del $PHPIZE_DEPS \
    && rm -rf /tmp/* /var/cache/apk/*

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Copy composer files first for better layer caching
COPY composer.json composer.lock ./

# Install PHP dependencies (production only, optimized)
RUN composer install \
    --no-dev \
    --no-interaction \
    --no-scripts \
    --no-progress \
    --prefer-dist \
    --optimize-autoloader

# Copy application code
COPY . .

# Run Laravel optimization commands
#RUN php artisan config:cache \
#    && php artisan route:cache \
#    && php artisan view:cache

# ========================================
# Stage 2: Production Stage
# ========================================
FROM php:8.3.6-fpm-alpine

# Set working directory
WORKDIR /var/www/html

# Install runtime dependencies only (no build tools)
RUN apk add --no-cache \
    curl \
    libzip \
    zip \
    oniguruma \
    libpng \
    libjpeg-turbo \
    freetype \
    icu-libs \
    mysql-client \
    supervisor \
    # PDF runtime dependencies
    poppler-utils \
    ghostscript \
    imagemagick \
    && rm -rf /tmp/* /var/cache/apk/*

# Copy PHP extensions from builder stage (including Redis, Imagick, and all other extensions)
COPY --from=builder /usr/local/lib/php/extensions/ /usr/local/lib/php/extensions/
COPY --from=builder /usr/local/etc/php/conf.d/ /usr/local/etc/php/conf.d/

# Copy custom PHP configuration
COPY docker/php/php.ini /usr/local/etc/php/conf.d/custom.ini

# Copy supervisor configuration
COPY docker/supervisor/supervisord.conf /etc/supervisord.conf

# Copy application from builder stage
COPY --from=builder --chown=www-data:www-data /var/www/html /var/www/html

# Copy vendor from builder stage
COPY --from=builder --chown=www-data:www-data /var/www/html/vendor /var/www/html/vendor

# Set proper permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html/storage \
    && chmod -R 755 /var/www/html/bootstrap/cache

# Create startup script for migrations and optimizations
RUN echo '#!/bin/sh' > /usr/local/bin/start.sh \
    && echo 'set -e' >> /usr/local/bin/start.sh \
    && echo '' >> /usr/local/bin/start.sh \
    && echo 'echo "Starting UrbanGreen Application..."' >> /usr/local/bin/start.sh \
    && echo '' >> /usr/local/bin/start.sh \
    && echo '# Wait for database to be ready' >> /usr/local/bin/start.sh \
    && echo 'echo "Waiting for database connection..."' >> /usr/local/bin/start.sh \
    && echo 'until php artisan migrate:status > /dev/null 2>&1; do' >> /usr/local/bin/start.sh \
    && echo '    echo "Database not ready - waiting..."' >> /usr/local/bin/start.sh \
    && echo '    sleep 2' >> /usr/local/bin/start.sh \
    && echo 'done' >> /usr/local/bin/start.sh \
    && echo '' >> /usr/local/bin/start.sh \
    && echo '# Run migrations' >> /usr/local/bin/start.sh \
    && echo 'echo "Running database migrations..."' >> /usr/local/bin/start.sh \
    && echo 'php artisan migrate --force' >> /usr/local/bin/start.sh \
    && echo '' >> /usr/local/bin/start.sh \
    && echo '# Clear and cache configurations (in case env changed)' >> /usr/local/bin/start.sh \
    && echo 'echo "Optimizing application..."' >> /usr/local/bin/start.sh \
    && echo 'php artisan config:cache' >> /usr/local/bin/start.sh \
    && echo 'php artisan route:cache' >> /usr/local/bin/start.sh \
    && echo 'php artisan view:cache' >> /usr/local/bin/start.sh \
    && echo '' >> /usr/local/bin/start.sh \
    && echo '# Start supervisor to manage PHP-FPM, queue workers, and scheduler' >> /usr/local/bin/start.sh \
    && echo 'echo "Starting services..."' >> /usr/local/bin/start.sh \
    && echo 'exec /usr/bin/supervisord -c /etc/supervisord.conf' >> /usr/local/bin/start.sh \
    && chmod +x /usr/local/bin/start.sh

# Switch to non-root user for security
#USER www-data

# Expose PHP-FPM port
EXPOSE 9000



# Start the application
CMD ["/usr/local/bin/start.sh"]
