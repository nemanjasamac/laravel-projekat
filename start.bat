@echo off
echo ====================================================
echo  Nemanja Samac IT66/23
echo ====================================================

echo [1/8] Kopiranje .env fajla...
IF NOT EXIST ".env" (
    copy .env.example .env
    echo .env fajl napravljen.
) ELSE (
    echo .env fajl postoji.
)

echo [2/8] Instsaliranje composer-a
call composer install --no-interaction
if %ERRORLEVEL% NEQ 0 (
    echo Error
    pause
    exit /b 1
)

echo [3/8] NPM instalacija
call npm install
if %ERRORLEVEL% NEQ 0 (
    echo neuspesno instaliranje npm modula
)

echo [4/8] Kompjliranje frontend-a
call npm run build
if %ERRORLEVEL% NEQ 0 (
    echo Error: neuspesno kompjliranje frontend-a!
    echo Pravljenje manifest.json datoteke...
    
    if not exist "public\build" mkdir "public\build"
    echo { > "public\build\manifest.json"
    echo   "resources/js/app.js": { >> "public\build\manifest.json"
    echo     "file": "assets/app.js", >> "public\build\manifest.json"
    echo     "isEntry": true >> "public\build\manifest.json"
    echo   }, >> "public\build\manifest.json"
    echo   "resources/css/app.css": { >> "public\build\manifest.json"
    echo     "file": "assets/app.css", >> "public\build\manifest.json"
    echo     "isEntry": true >> "public\build\manifest.json"
    echo   } >> "public\build\manifest.json"
    echo } >> "public\build\manifest.json"
    
    echo napravljen manifest.json placeholder
)

echo [5/8] Generisem app key
call php artisan key:generate
if %ERRORLEVEL% NEQ 0 (
    echo Error: neuspesno generisanje app key-a!
    pause
    exit /b 1
)

echo [6/8] Migracije i seedovanje
call php artisan migrate:fresh --seed
if %ERRORLEVEL% NEQ 0 (
    echo Error: Neuspesne miracije i seedovanje baze podataka!
    pause
    exit /b 1
)

echo [7/8] Pravljenje storage link-a
call php artisan storage:link

echo [8/8] Ciscenje cache-a
call php artisan config:clear
call php artisan cache:clear
call php artisan view:clear

echo ====================================================
echo  Setup gotov
echo ====================================================
echo.
echo  Nalozi:
echo - Admin:    admin@pwa.rs     / admin
echo - Editor:   editor@pwa.rs    / editor
echo - User:     user@pwa.rs      / user
echo.
echo Pokretanje servera
echo.

call php artisan serve

pause