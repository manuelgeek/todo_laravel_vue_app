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
    
Create database tables and run seeder. The seeder sets up a user account.

`php artisan migarate --seed`

#### Build Vue Assets

`npm install`
`npm run watch` for development or run `npm run prod` to build prod assets

#### start server

`php artisan serve`

## APIs Postman Collection
https://www.getpostman.com/collections/8b7fb39d21cd94b2c310

## API Documentation
https://documenter.getpostman.com/view/3385291/UUxwBTm3

## What I would have done given more time
- Forgot and reset password UIs, the APIs are already created
- 
## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
