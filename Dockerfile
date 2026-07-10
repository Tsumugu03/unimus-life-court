FROM richarvey/nginx-php-fpm:latest

COPY . .


ENV SKIP_COMPOSER 0
ENV WEBROOT /var/www/html/public
ENV PHP_ERRORS_STDERR 1

RUN chmod +x /var/www/html/deploy.sh
CMD ["/var/www/html/deploy.sh"]