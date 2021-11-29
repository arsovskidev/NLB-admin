# NLB-admin

#### The back-end solution for NLB Hackathon Open Finance Banking.

###### Clone and install composer dependencies.

```
$ git clone git@github.com:arsovskidev/NLB-admin.git
$ cd NLB-admin

$ composer install
```

###### Rename the .env.example file to .env and change the following settings.

```
$ mv .env.example .env
$ nano .env

DB_DATABASE= YOUR_DATABASE_NAME
DB_USERNAME= YOUR_MYSQL_USERNAME
DB_PASSWORD= YOUR_MYSQL_PASSWORD
```

###### Migrate the database and seed it.

```
$ php artisan migrate --seed
```

###### You are now done with setting up, go ahead and run the project!

```
$ php artisan serve
```
