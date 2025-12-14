# Sử dụng PHP kèm Apache
FROM php:8.1-apache

# Cài đặt Driver để PHP kết nối được với PostgreSQL
RUN apt-get update && apt-get install -y libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql

# Copy toàn bộ code vào thư mục web của server
COPY . /var/www/html/

# Mở cổng 80
EXPOSE 80