<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

## TODO App

Laravel and Vue 3 TODO App

## Set up

`composer install`

`php artisan key:generate`

`cp .env.example .env`

### ENV config:

- Add database, Email, AWS, s3 configs to `.env`

- Add the necessary env values; database, email, app name, app url etc
- To test for reset password, set email variables, alternatively, set `MAIL_HOST=log` for local email testing
    
Create database tables and run seeder. The seeder sets up a user account.

`php artisan migarate --seed`

#### Build Vue Assets

`npm install`
`npm run watch` for development or run `npm run prod` to build prod assets

#### start server

`php artisan serve`

## Docker 
### Set up
- Make sure you have docker installed
- Assumes you have your .env file - in case you're using automated CD/CD -  you can add step to create .env from .env.example and adding values,

database env vars - for demo purposes inside docker
```dotenv
DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=todo_laravel_vue_app
DB_USERNAME=root
DB_PASSWORD=password
```

### Start docker
`docker-compose up -d`

optional 

`docker-compose exec app php artisan config:cache`

you can run more commands via

`docker-compose exec app [command here]`

access you app via 

`http:your_ip:8000`

## APIs Postman Collection
https://www.getpostman.com/collections/8b7fb39d21cd94b2c310

## API Documentation
https://documenter.getpostman.com/view/3385291/UUxwBTm3

## What I would have done given more time
- Forgot and reset password UIs, the APIs are already created
- Edit category
- Edit Task
- Handle task pagination - maybe use infinite scroll
## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
