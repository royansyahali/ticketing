<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Ticketing App
Database 
- Name = etiket

To start application you can run command
- "php artisan server" with path in directory application

# 5 endpoint in this application
## 1. Route: 
- "api/tiket/{limit}" with a limit parameter of type integer 
### Description
- Get data tiket 
### Paramenter
- limit = type integer
### Method 
- GET
### Header 
- Content-Type = application/json
- X-API-KEY = R@h4s14

## 2. Route: 
- "api/add-tiket" 
### Description
- Create a tiket 
### Method 
- GET
### Header 
- Content-Type = application/json
- X-API-KEY = R@h4s14
### Request Body 
- subject = type string 
- message = type string
- priority = with value Low or High or Medium of type string


## 3. Route: 
- "api/reply-tiket" 
### Description
- Change a Status tiket to Answered
### Method 
- PATCH
### Header 
- Content-Type = application/json
- X-API-KEY = R@h4s14
### Request Body 
- message = type string 
- tiket_number = type string

## 4. Route: 
- "api/closed-tiket" 
### Description
- Change a Status tiket to Closed
### Method 
- PATCH
### Header 
- Content-Type = application/json
- X-API-KEY = R@h4s14
### Request Body 
- tiket_number = type string


## 5. Route: 
- "api/delete-tiket" 
### Description
- Remove a tiket 
### Method 
- DELETE
### Header 
- Content-Type = application/json
- X-API-KEY = R@h4s14
### Request Body 
- id = type string

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
