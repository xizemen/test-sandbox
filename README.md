# Installation

* Open terminal in the suitable location for this project


* Execute ```git clone https://github.com/xizemen/test-sandbox.git```
  

* Change the current directory to the project's directory ```cd test-sandbox```
  

* Fetch all the latest origin branches ```git fetch --all```
  

* Go to /www directory ```cd www```
  

* Create your .env file from the example ```cp .env.example .env```
  

* In the same directory(/www), execute composer ```composer install```
  

* Step out to the project root directory ```cd ..```
  

* To remove any existing conflicting containers, images, and volumes, from the command line run the following:
  ```docker-compose down```
  ```yes | docker system prune -a```
  ```docker volume rm $(docker volume ls -q)```
  ```docker images purge -a```
 

* Run docker-compose ```docker-compose up -d``` 
  

* Wait until the installation of webserver and db is done - it will take some time
  

* If installation is complete, access webserver container ```docker exec -ti mend-webserver /bin/bash```
  

* Clear laravel configs cache ```php artisan config:clear```


* Generate laravel app. encryption key ```php artisan key:generate```


* Cache laravel configs ```php artisan config:cache```
 

* Now, you can run laravel migrations to set up tasks DB table ```php artisan migrate```
  

* Ensure laravel feature tests are OK: 
  * Go to webserver container ```docker exec -ti mend-webserver /bin/bash```
  * Clear laravel configs cache ```php artisan config:clear```
  * Run tests inside the container ```./vendor/bin/phpunit```
  * Cache laravel configs ```php artisan config:cache```
    

* [OPTIONAL] You may seed DB tasks table ```php artisan db:seed```
  

* Open http://localhost in your browser
  

* The Task List page is rendered and ready for the work.

--------
## Listing of directories & files:

* /bin/webserver/Dockerfile - expose port 80 & serve laravel project


* /www - laravel project is inside
  

* /www/app/Exceptions/Handler.php - custom Exception handling logic
  

* /www/app/Exceptions/NonExistentTaskException.php
  

* /www/app/Http/Controllers/ErrorController.php
* /www/app/Http/Controllers/TaskController.php
* /www/app/Http/Middleware/XssFilter.php
  

* /www/app/Http/Requests/CreateTaskRequest.php
* /www/app/Http/Requests/DeleteTaskRequest.php
* /www/app/Http/Requests/GetTaskRequest.php
* /www/app/Http/Requests/UpdateTaskRequest.php
  

* /www/app/Models/Task.php
  

* /www/app/Providers/FormRequestProvider.php


* /www/app/Repositories/TaskRepository.php
  

* /www/app/Services/TaskService.php
  

* /www/database/factories/TaskFactory.php
  

* /www/database/migrations/<MIGRATION_DATE>_create_tasks_table.php
  

* /www/database/seeds/TaskSeeder.php
  

* /www/routes/web.php
  

* /www/tests/Feature/ErrorPageTest.php
* /www/tests/Feature/TaskCreateTest.php
* /www/tests/Feature/TaskDeleteTest.php
* /www/tests/Feature/TaskIndexTest.php
* /www/tests/Feature/TaskUpdateTest.php


* /README.md
--------

### Connect to MySQL

Connect to MySQL container
```
> docker exec -ti mend-mysql /bin/bash
```

Now you can access MySQL:
```
root@96362952ce65:/# mysql -u root -p 
Enter password: 

Welcome to the MySQL monitor.  Commands end with ; or \g.
Your MySQL connection id is 6
Server version: 5.7.29 MySQL Community Server (GPL)

Copyright (c) 2000, 2020, Oracle and/or its affiliates. All rights reserved.

Oracle is a registered trademark of Oracle Corporation and/or its
affiliates. Other names may be trademarks of their respective
owners.

Type 'help;' or '\h' for help. Type '\c' to clear the current input statement.

mysql>
```