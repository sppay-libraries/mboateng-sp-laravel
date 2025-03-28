### Installation
> Require this package in your composer.json and update composer

1. **composer require sppay/sspay-laravel**  
   Run the following command to install the package in your project:
   ```sh
   composer require sppay/sspay-laravel
   ```

2. **Publish Config files**  
   Copy packages config file to your own config directory to modify the values where necessary
   ```sh
   php artisan vendor:publish --tag=sppay-config
   ```

3. **Publish View files**  
   Run the command below to copy the views in your vendor/view dir:
   ```sh
   php artisan vendor:publish --tag=sppay-views
   ```

4. **Publish Migrations**  
   Copy the migration files into your migrations dir:
   ```sh
   php artisan vendor:publish --tag=sppay-migrations 
   ```
   
5. **Run Migrations**  
   Migrate the package's migrations files you just copied
   ```sh
   php artisan migrate 
   ```
   
Update the .env file with the appropriate values for your setup.

> AUTH_CLIENT_GRANT_TYPE=  
AUTH_CLIENT_ID=  
AUTH_CLIENT_SECRET=  
AUTH_CLIENT_USERNAME=  
AUTH_CLIENT_PASSWORD=  
SPPAY_BASE_URL=  

