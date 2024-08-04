# gis-kurima-papua
Laravel 11
## Panduan Penggunaan
- Jalankan `composer update` In directory root projct
- Kemudian jalankan `copy .env.example .env`
- Selanjutnya jalankan `php artisan key:generate`
- Buat databas <b>Kurima</b> di phpmyadmin
- Langkah selanjutnya setting database nya di .env sebagai berikut:
    ```env
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=wisata_jepara
    DB_USERNAME=YOUR_USERNAME
    DB_PASSWORD=YOUR_PASSWORD
    ```
- Lanjut jalankan `php artisan migrate`
- Jalankan `php artisan storage:link`
- Kemudian `php artisan db:seed`
- Dan yang terakhir jalankan `php artisan serve`
- Login System dengan mengguanka user
    ```
    LOGIN ADMIN
    email : dev.burhanuddin@gmail.com
    password : Admin123
    ```
- Well Done
