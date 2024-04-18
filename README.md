### About this app
This is a back end API service developed for an assignment (Mid-Level).

Tech stack is listed below:
1) PHP (8.2)
2) Laravel (11.3)
3) MySQL (8.0.36 - 0ubuntu0.22.04.1 for Linux on x86_64 - Ubuntu)
4) Nginx 1.18.0 Ubuntu

The development was made in Ubuntu 22.04

### Steps to run the project
If you are running Linux OS or Mac OS you will need to install composer and mysql.
If you are using windows I have made a small guideline in order to install only the Laragon Software.
It has more steps, but you can remove it after inspecting the project with all its dependencies.

Windows Setup
1) Download Laragon (https://github.com/leokhoa/laragon/releases/download/6.0.0/laragon-wamp.exe)
2) Install Laragon

3) Open Laragon and select button named "Root"
4) git clone https://github.com/GeorgeKrs/agroapps.git
5) Create a database with the name agroapps_database
6) Create a .env file in the root directory and copy the content from .env.example

7) Download php version 8.2 (https://windows.php.net/downloads/releases/php-8.2.18-nts-Win32-vs16-x64.zip)
8) Navigate to laragon/bin/php and create a folder php-8.2
9) Extract the content of step 5 into the folder you created in the previous step
10) Return to Laragon screen, right-click anywhere on the "white space", PHP > Version and then select the php-8.2 version
11) Right-click anywhere on the "white-space", PHP > Extensions and add zip option if it is not selected

12) Select button Terminal and run "cd agroapps/"
13) Run composer install

14) Import the dumb sql file (it is located in the root directory of project, name: agroapps_database.sql)

15) Go to Laragon app and press Start All button
16) Then Select button Terminal and run "cd agroapps/"
17) Run php artisan serve
18) Run php artisan queue:work

Bonus:
You can find a z_postman_apis folder in the root directory of the project. 
These are the APIs collections from postman in json format so that you can import them if you need to.

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
