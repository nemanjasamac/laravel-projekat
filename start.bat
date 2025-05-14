@echo off

IF NOT EXIST .env (
    COPY .env.example .env
    ECHO Created .env file. Please update database settings if needed.
) ELSE (
    ECHO .env file already exists.
)

composer install

php artisan key:generate

php artisan storage:link

php artisan migrate:fresh --seed

php artisan config:clear
php artisan route:clear
php artisan cache:clear
php artisan view:clear

npm install

npm run build

ECHO ==================================
ECHO Projekat Rad Advokatske Kancelarije instaliran
ECHO ==================================

php artisan serve

pause