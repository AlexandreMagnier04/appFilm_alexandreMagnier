FROM php:8.2-fpm

# Installer les dépendances système
RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libjpeg-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    curl \
    git \
    nano \
    libzip-dev \
    sqlite3 \
    libsqlite3-dev

# Installer les extensions PHP requises
RUN docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath gd zip

# Installer Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Créer le répertoire de l'application
WORKDIR /var/www

# Copier les fichiers du projet
COPY . .

# Installer les dépendances PHP
RUN composer install --no-interaction --prefer-dist --optimize-autoloader

# Fix permissions
RUN chmod -R 775 storage bootstrap/cache

# Générer clé Laravel automatiquement (optionnel)
RUN php artisan key:generate

# Port exposé par Laravel avec php -S
EXPOSE 8000

CMD php -S 0.0.0.0:8000 -t public
