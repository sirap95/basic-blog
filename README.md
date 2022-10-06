# Basic Blog

Basic Blog is a free easy to use template to create your first blog.

The focus of this template is the backend, it will allow you to practice with Laravel and all the basic function to
start learning and improve your knowledge. You will just need to apply a bootstrap template for the guest side.

Current version: V0.5

Laravel v9.3.1

PHP v8.1.0

## Release:

v0.1:

- Basic Template with basic post creation
- Admin panel to create, edit and delete articles

v0.2:

- CKEditor implementation to create the content of your Article
- Image Upload function
- HTML Template Adoption
- Views counter

v0.3

- adoption of CKEditor to edit content of post
- Main Picture upload in Post page
- Add Preview Picture
- Search Bar
- Table of posts for Admin
- Secured routes With CSRF_TOKEN
- Pagination in guest/Index.blade

v0.4

- Tag implementation
- Admin Detail Page
- Admin Info in Index and Post page

v0.5

- Implementation of AWS S3
- Minor bugfix

## Installation

If you have already a working enviroment skip to the section 2

otherwise:

- [Install Laravel](https://laravel.com/docs/9.x/installation)
- [Install IDE es. visual studio code](https://code.visualstudio.com/download)
- [Create AWS Account and S3 Bucket](https://docs.aws.amazon.com/AmazonS3/latest/userguide/create-bucket-overview.html)

section 2:

```bash
#clone the repository
git clone https://github.com/sirap95/basic-blog.git

#run composer
composer install

#create .env file
mv .env.example .env

#generate the key in the .env file
php artisan key:generate

#add database address, name, user and password
sudo nano .env ( check if php generated correctly your key and add the info of your database in the .env file)

#create all the necessary tables
php artisan migrate

#seed the database if you want
php artisan db:seed (if you want the tags I used to develop the blog)
```

- Configure the S3 credentials on .env file

## DEMO Website

[BASIC BLOG DEMO](https://basicblogdemo.com:16391)

## Author

[@sirap95](https://www.github.com/sirap95)

## Template Informations

In this project I'm using this HTML template, below the informations about it.

- Template Name: Forest Time

- Created By: HTML.Design

- http://themeforest.net/user/wpdestek
