# Currency Converter Laravel App

This app is developer by Jaykumar Momaya as assignment for Densou Interview process.

#Dependencies

## Dependencies
```bash
Php: 8
MySQL: 8
Composer: 2
Laravel: 9
```

## Installation
Clone this repository

Run ```composer install``` to install Laravel and its dependencies

Create a new database in MySQL 8

Copy ```.env.example``` to ```.env``` and update the ```DB_*``` variables with your MySQL 8 database credentials
##
To generate an application key run
```bash 
php artisan key:generate
```
To run the database migrations run
```bash 
php artisan migrate
``` 
To run the seed the data
```bash 
php artisan db:seed
``` 
To start the development server run
```bash 
php artisan serve
```