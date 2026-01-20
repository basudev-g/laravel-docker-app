FROM php:8.4-apache

# সিস্টেম লাইব্রেরি ইন্সটল
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    git \
    curl \
    libzip-dev

# পিএইচপি এক্সটেনশন ইন্সটল (আলাদা RUN ব্যবহার করুন)
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip

# ৩. অ্যাপাচি কনফিগারেশন এবং মোড-রিরাইট এনাবল করা
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf
RUN a2enmod rewrite

# ৪. কম্পোজার ইন্সটল
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# ৫. পারমিশন ফিক্স: আপনার পিসির ইউজারের (১০০০) সাথে ডকার ইউজারকে সিঙ্ক করা
RUN usermod -u 1000 www-data && groupmod -g 1000 www-data

WORKDIR /var/www/html

# ৬. প্রজেক্ট ফাইল কপি করার আগে ওনারশিপ সেট করা
RUN chown -R www-data:www-data /var/www/html