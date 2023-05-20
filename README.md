## INSTALASI

1. Jalankan fungsi **Composer**

    ```bash
        composer install
    ```

2. Copy file **.env.example** ke **.env**
    ```bash
      cp .env.example .env
    ```
3. Generate Key

    ```bash
      php artisan key:generate
    ```

4. Jalankan migrasi **database**
    ```bash
    php artisan migrate:fresh
    ```
5. Jalankan fungsi **seeder**
    ```bash
    php artisan db:seed
    ```
