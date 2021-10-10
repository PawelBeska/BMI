## Wymogi

 - `PHP > 8.0.0`
 - `Composer`
 - `Mysql`
 - `Serwer poczty`

## Instalacja

 - Plik .env.example zamienić na .env
 - Dodać do pliku .env dane do bazy oraz serwera poczty
   - Mysql:
        - `DB_CONNECTION=mysql'
        - 'DB_HOST=127.0.0.1'
        - 'DB_PORT=3306'
        - 'DB_DATABASE=bmi'
        - 'DB_USERNAME=root'
        - 'DB_PASSWORD=`
    - Poczta (Polecam skorzystać z usług mailtrap.io):
        -  MAIL_MAILER=smtp
        -  MAIL_HOST=smtp.mailtrap.io
        -  MAIL_PORT=2525
        -  MAIL_USERNAME=username
        -  MAIL_PASSWORD=password
        -  MAIL_ENCRYPTION=tls
        -  MAIL_FROM_ADDRESS=bmi@example.com
        -  MAIL_FROM_NAME="${APP_NAME}"
 - Uruchomić polecenie `composer update`
 - Uruchomić polecenie `php artisan key:generate`
 - Uruchomić polecenie `php artisan migrate`
 - Uruchomić polecenie `php artisan serve` - nasz serwer powinnien pojawić się na url http://localhost:8000/
     
