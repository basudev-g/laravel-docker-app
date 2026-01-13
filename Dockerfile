FROM php:8.4-apache

# ১. লারাভেলের জন্য প্রয়োজনীয় সিস্টেম লাইব্রেরি ইন্সটল
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    git \
    curl \
    libzip-dev

# ২. পিএইচপি এক্সটেনশন ইন্সটল
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip

# ৩. অ্যাপাচি মোড-রিরাইট এনাবল করা (লারাভেলের রুটিংয়ের জন্য জরুরি)
RUN a2enmod rewrite

# ৪. কম্পোজার (Composer) ইন্সটল করা
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# ৫. আমাদের কাস্টম php.ini ফাইল কপি করা (পরের ধাপে এটি বানাবো)
# COPY php.ini /usr/local/etc/php/

# Apache কনফিগারেশনে ডকুমেন্ট রুট পরিবর্তন করা
ENV APACHE_DOCUMENT_ROOT /var/www/html/public

RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf
