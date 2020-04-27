
<h1>TO RUN THIS APP LOCALLY IN YOUR MACHINE</h1>

1. clone it inside htdocs in your machine.
(Xamppp or Lamp or Wamp is needed for apache server)
2. composer install
3. Copy .env.example file to .env on the root folder
4. Open your .env file and change the database name to whatever you have created in phpmyadmin, username is 'root' bydefault and leave password empty
5. Run php artisan key:generate
6. Run php artisan migrate
7. Install Passport Package 
    ->composer require laravel/passport
    then migrate
    ->php artisan migrate
    then create personal access and password grant clients 
    ->php artisan passport:install
    then modify auth.php file inside config dir. api drivers to 'passport'
    also modify some other files (please refer to laravel docs for this)
(7. php artisan db:seed )## not necessary... for this, you might need to create a seeder. mero vai leave it.
8.  Get your Access Token
7. Run php artisan serve
8. Go to localhost:8000
