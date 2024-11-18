remarks!!
-make sure run all command in root folder



Process to clone and Set Up:

1.  run command : git clone https://github.com/aliffiman31/assignment2.git
2.  run command : composer install
3.  run command : php artisan key:generate


Set Up Database 

1.  create new database cmanagement
2.  change DB_DATABASE=Laravel -> DB_DATABASE=cmanagement (.env file)
3.  run command : php artisan migrate
4.  run command : php artisan db:seed
