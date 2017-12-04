FROM composer as build
ADD composer.* /app/
RUN composer install --no-interaction --prefer-dist

FROM php:alpine
ADD ./src /app/src
COPY --from=build /app /app
WORKDIR /app/src
CMD ["php", "-f", "app.php"]