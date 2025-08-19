# Utilise PHP avec Apache
FROM php:8.2-apache

# Copie ton code PHP dans le conteneur
COPY src/ /var/www/html/

# Active l'extension mysqli
RUN docker-php-ext-install mysqli

# Supprime l'avertissement Apache sur le ServerName
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

# Expose le port 80 pour HTTP
EXPOSE 80
