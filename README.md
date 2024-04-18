### About this app
This is a back end API service developed for AgroApp's assignment (Mid-Level).

Tech stack is listed below:
1) PHP (8.2)
2) Laravel (11.3)
3) MySQL (8.0.36 - 0ubuntu0.22.04.1 for Linux on x86_64 - Ubuntu)
4) Nginx 1.18.0 Ubuntu

PHP (8.2) Laravel (11.3) framework for AgroApp's assignment (Mid-Level).

### Steps to run the project
1) Git clone the project
2) Create an .env file and then copy the structure from .env.example 
3) Open a terminal and run **php artisan serve** in order for the server to start. 4
4) Open a second terminal and run **php artisan queue:work** in order for the queue to start.

### Development & Testing Data
I have created model factories both for development and testing purposes.
If you need more data you can run multiple times the command **php artisan app:development-data**

P.S. All users have as password the word: password

### Postman APIs
Moreover, you will find a postman directory (on root project directory) that contains the endpoints both for
testing & development. 

There are global variables available in order to help you make only the minimum
changes that need to be done in order to use or test the APIs (for example authToken global variable is set for
token authorization).

### Database
In this project I am using MySQL database. There is a dumb sql file of a database with development data
ready to be imported (on root project directory)

### Closure
If you have any questions please let me know! :)

### My Social Media
- [Personal Portfolio](https://georgekoursoumis.web.app/)
- [LinkedIn](https://www.linkedin.com/in/gkoursoumis/)
- [GitHub](https://github.com/GeorgeKrs)
