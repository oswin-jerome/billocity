<p align="center">:fire::fire::fire:Billocity:fire::fire::fire:</p>
composer config -g -- disable-tls true


### Software Requirements
* Laravel 8
* PHP > 7.4
* MySql
* Composer
* node > 14

### Project setup
* Clone git project
   > `git clone git@github.com:oswin-jerome/billocity.git`
* Install composer dependencies
    > `composer install`
* Install NPM dependencies
    > `npm install`
* copy .env file
    > `cp .env.example .env`
* Fill all necesary values in .env
* Generate App Key
    > `php artisan key:generate`
* Migrate and seed database
    > `php artisan migrate --seed`
* Run dev server
    > `php artisan serve`


### Database setup
* #### DB configuration
    * Create a MySQL database
    * Set database parameters in `.env` file 
    *  `DB_CONNECTION= mysql`
    * `DB_HOST=` your db host
    * `DB_PORT=` your db port (default is 3306)
    * `DATABASE_NAME=` db_name
    * `DB_USERNAME=` your db username
    * `DB_PASSWORD=` your db password
* #### Migration
    * Run `php artisan migrate` 

* #### Seeding
    * Run `php artisan db:seed`

* #### File structured
    * Migration files are stored in `database/migrations`
    * Seeders are stored in `database/seeders`
    * Factories are stored in `database/factories`


### File structure
* `app`
    * `http`
        * `- Controllers` all controllers are places in this folder
        * `- Livewire` all logic of livewire components are placed here
        * `- Resources` all resource files are placed here
    * `models` all model classes are placed here
* `config` application level configuration
* `database`
    * `- migrations` migration files
    * `- factory` factory for generating fake data
    * `- seeders` seeders for seeding fake data into db
 * `resources` contains all view files and other css and js files
 * `routes` file to handle all api,web, channel & command routes.
    * `- web.php` handles all the web related routes in the application
     
