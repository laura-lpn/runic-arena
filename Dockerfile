# Utilisation de FrankenPHP
FROM dunglas/frankenphp

# Définir le répertoire de travail
WORKDIR /app

# Copier les fichiers du projet
COPY . .

# Installer les dépendances PHP
RUN composer install --no-dev --optimize-autoloader

# Installer les assets avec Asset Mapper
RUN symfony console asset-map:compile

# Définir le port d'écoute
EXPOSE 80

# Lancer FrankenPHP
CMD ["frankenphp", "serve", "--port", "80"]
