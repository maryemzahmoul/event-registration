# Utilise PHP avec Apache
FROM php:8.2-apache

# Copie ton code PHP dans le conteneur
COPY src/ /var/www/html/

# Active les extensions nécessaires (ici mysqli)
RUN docker-php-ext-install mysqli

# Expose le port 80 pour HTTP
EXPOSE 80
