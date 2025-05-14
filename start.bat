@echo off
echo ====================================================
echo  Nemanja Samac IT66/23 - Project Setup
echo ====================================================

IF NOT EXIST ".env" (
    copy .env.example .env
) ELSE (
    echo .env vec postoji
)

call composer install --no-interaction
if %ERRORLEVEL% NEQ 0 (
    echo Error: Failed to install Composer dependencies!
    echo Please make sure Composer is installed and in your PATH.
    pause
    exit /b 1
)

call npm install
if %ERRORLEVEL% NEQ 0 (
    echo Warning: Failed to install NPM packages. Continuing anyway...
)

call php artisan key:generate
if %ERRORLEVEL% NEQ 0 (
    echo Error: Failed to generate application key!
    pause
    exit /b 1
)

call php artisan migrate:fresh --seed
if %ERRORLEVEL% NEQ 0 (
    echo Error
    pause
    exit /b 1
)

call php artisan storage:link


call php artisan config:clear
call php artisan cache:clear
call php artisan view:clear


call php artisan serve

pause