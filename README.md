![Home](https://res.cloudinary.com/dbiliw2ja/image/upload/v1694937719/Home_dfswgb.png)
![Single](https://res.cloudinary.com/dbiliw2ja/image/upload/v1694937784/Single_vnabmb.png)
![Add/edit](https://res.cloudinary.com/dbiliw2ja/image/upload/v1694937718/Add-edit_tvjybt.png)
![Manage](https://res.cloudinary.com/dbiliw2ja/image/upload/v1694937718/Manage_jtmquh.png)

### About this project 
This project served as a way for me to learn about Laravel and PHP.
As I said, don't expect any high-quality features or UI.
Tech using: Laravel, Mysql (phpmyadmin), Tailwindcss

### Features
- Fully responsive design using and TailwindCSS
- Register/Login function
- Search/filter job with specific position, tag, description
- Pagination
- Shareable search/filter URL
- Jobs management with create, update and delete function

### Prerequisites

**Composer**

**Laravel**

### Database set up
1. First you will have to create a database on phpmyadmin with whatever name you like
2. Then create an .env file with all the same variable from .env.example
3. Change the value of DB_DATABASE to the db name that you have created  
4. After that run the command below 

```shell
php artisan migrate
```

## You can create dummy data by using this command
```shell
php artisan migrate:refresh --seed
```

### How to run
```shell
php artisan serve
```

