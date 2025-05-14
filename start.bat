@echo off
echo -------------------------------------
echo Nemanja Samac IT66/23
echo -------------------------------------

IF NOT EXIST ".env" (
    copy .env.example .env
) ELSE (
    echo .env vec postoji
)

echo Composer instalacija
composer install

echo NPM instalacija
npm install

echo App kljuc generacija
php artisan key:generate

echo Postavljanje migracija, seederi
php artisan migrate:fresh --seed

echo Pokretanje servera :D
php artisan serve

pause
