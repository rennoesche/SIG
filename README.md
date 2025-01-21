<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Use this project

For using this project, kindly read this carefully.
1. Clone this repository
2. Copy .env.example to .env , then modify .env
3. Install requirements using composer and npm
```
composer install
```
```
npm install
```
4. Generate key using php
```
php artisan key:generate
```
5. Migrate the schema
```
php artisan migrate
```
6. Run the import commands
```
php artisan app:import-provinsi
```
```
php artisan app:import-kabkota
```
```
php artisan app:import-data
```
7. Generate filament-user
```
php artisan make:filament-user
```
8. Start php service
```
composer run dev
```
or
```
php artisan serve
```
```
npm run dev
```
