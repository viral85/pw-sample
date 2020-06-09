# Picture-Works

- git clone

	`git clone https://github.com/viral85/pw-sample.git`


- composer

	`composer install`

	`composer update`


- make copy of .env from .env.example

	`cp .env.example .env`


- add your database related configuration

	DB_CONNECTION=pgsql

	DB_HOST=127.0.0.1
	
	DB_PORT=3306
	
	DB_DATABASE=pwworks
	
	DB_USERNAME=root
	
	DB_PASSWORD=


- add application key

	`php artisan key:generate`


- cache all configurations

	`php artisan config:cache`


- migrate & seed

 	`php artisan migrate --seed`


- serve application

	`php artisan serve --port=8080`


- add comment from console command

	command accept 2 arguments. ID and Comment. 1 is ID, 'Hello Viral' is Comment

	`php artisan add:comment 1 'Hello Viral'`


- unit test

	`./vendor/bin/phpunit --filter 'Tests\\Feature'`


- I have used users and comments table. User have many comments. I have used repositories to retrive user details, store user's comments.

- I created 2 forms for comments. Post request and Json request. Validate all input fields in both case.

- Console command accept 2 argument to store user's comment. Valid user id can add comment [no password required].


## Thank you!