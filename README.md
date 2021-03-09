## How to run
Inside the project directory:

Install php dependencies

`composer install`

create .env from .env.backup

`cp .env.example .env`

Generate the Application Key

`php artisan key:generate`

To populate the db with fake data, first you need to create the sqlite db

`touch database/database.sqlite`

Then run the migrations

`php artisan migrate:fresh --seed`

Otherwise just

`php artisan migrate:fresh`

Then install npm dependencies

`npm install`


And start the server

`php artisan serve`

To Login with fake data use

`test@test.com` : `testPassword123`
