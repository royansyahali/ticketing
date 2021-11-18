<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Ticketing App
To start application:
- run composer install use CLI with path directory application
- rename .env.copy .env <br>
change the database name (DB_DATABASE) to whatever you have, username (DB_USERNAME) and password (DB_PASSWORD) field correspond to your configuration.
By default, the username is root and you can leave the password field empty for database name is etiket.
- create database with name etiket if you use database name is etiket
- run php artisan key:generate use CLI with path directory application
- run php artisan migrate use CLI with path directory application
- run php artisan server use CLI with path directory application
- go to localhost:8000

# 5 Endpoint in this application
## 1. Route: 
- "api/ticket/{limit}" with a limit parameter of type integer 
### Description
- Get tickets 
### Paramenter
- limit = type integer
### Method 
- GET
### Header 
- Content-Type = application/json
- X-API-KEY = R@h4s14

## 2. Route: 
- "api/add-ticket" 
### Description
- Create a ticket 
### Method 
- POST
### Header 
- Content-Type = application/json
- X-API-KEY = R@h4s14
### Request Body 
- subject = type string 
- message = type string
- priority = with value Low or High or Medium of type string


## 3. Route: 
- "api/reply-ticket" 
### Description
- Change a Status ticket to Answered
### Method 
- PATCH
### Header 
- Content-Type = application/json
- X-API-KEY = R@h4s14
### Request Body 
- message = type string 
- ticket_number = type string

## 4. Route: 
- "api/closed-ticket" 
### Description
- Change a Status ticket to Closed
### Method 
- PATCH
### Header 
- Content-Type = application/json
- X-API-KEY = R@h4s14
### Request Body 
- ticket_number = type string


## 5. Route: 
- "api/delete-ticket" 
### Description
- Remove a ticket 
### Method 
- DELETE
### Header 
- Content-Type = application/json
- X-API-KEY = R@h4s14
### Request Body 
- id = type string

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
