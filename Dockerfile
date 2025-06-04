# Usa una base immagine di PHP
FROM php:8.0-apache

# Installa dipendenze (se necessarie, ad esempio, moduli PHP)
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Copia i tuoi file PHP nella cartella di Apache
COPY . /var/www/html/

# Espone la porta 80
EXPOSE 80

# Avvia Apache in foreground
CMD ["apache2-foreground"]
