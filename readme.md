<p align="center"><img src="https://res.cloudinary.com/dtfbvvkyp/image/upload/v1566331377/laravel-logolockup-cmyk-red.svg" width="400"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

# UserEntriesTwitter
Create a web app that will have two parts. The first part involves entries (similar to blog posts)
from registered users (functionality to view, create, and edit entries). The second part is to be
able to see a single user's entries and tweets (from Twitter).

[Online Testing server](https://userentries.sophie-ware.com/)

## Application Info
**Framework:** Laravel 6 + VueJs

**Operation System:** Debian 9 | Apache 2.4.25 | PHP 7.3.11 | MariaDB (MySQL) 10.1.41

**Dependencies:** Laravel 6 Dependencies, cURL PHP extension, NodeJS

## General Deployment Instructions
1. Clone the repository:
    ```sh
        $ git clone https://github.com/rmendoza83/UserEntriesTwitter.git user-entries
    ```

2. Move to the new cloned folder:
    ```sh
        $ cd user-entries
    ```

3. Prepare the VueJS frontend code:
    ```sh
        $ npm install
        $ npm run prod
    ```

4. Prepare the Lavarel code:
    ```sh
        $ composer install
        $ cp .env.example .env
    ```

5. Fill the following configuration in your .env file:

    Configure your MariaDB Connection
    ```sh
        DB_CONNECTION=mysql
        DB_HOST=localhost
        DB_PORT=3306
        DB_DATABASE={YOUR_DESIRED_DBNAME}
        DB_USERNAME={MARIADB_USERNAME}
        DB_PASSWORD={MARIADB_PASSWORD}
    ```
    Configure your Twitter App keys
    ```sh
        TWITTER_CONSUMER_KEY=
        TWITTER_CONSUMER_SECRET=
        TWITTER_ACCESS_TOKEN=
        TWITTER_ACCESS_TOKEN_SECRET=
    ```
    For this step you can get this values in the following address [developer.twitter.com/en/apps](https://developer.twitter.com/en/apps)

6. Create an empty database inside MariaDB:
    ```sh
        $ mysql -u root -p
        $ Enter password: [type your {MARIADB_PASSWORD}]
        MariaBD [()]> CREATE DATABASE {YOUR_DESIRED_DBNAME};
        MariaBD [()]> quit
    ```

7. Configure Laravel Framework to get up the app (Create the Key App, Create the database, and Create Test data)
    ```sh
        $ php artisan key:generate
        $ php artisan migrate
        $ php artisan db:seed
    ```
8. Done. Just navigate to the configurated folder on Apache using a Navigator.

## Deployment Instructions (JobSity Specific)
In this case we need to create a new Virtual Host on Apache Environment, the steps are very similar to the General Instructions, but we need to add some steps before:

1. Create the project directory inside Apache documents folder (In Debian 9 by default: /var/www)
    ```sh
        $ mkdir -p /var/www/jobsitychallenge/reinaldo_mendoza
        $ cd /var/www/jobsitychallenge/reinaldo_mendoza
    ```

2. Clone repository
    ```sh
        $ git clone https://github.com/rmendoza83/UserEntriesTwitter.git .
    ```

3. Create **Virtual Host** [reinaldo-mendoza.jobsitychallenge.com](http://reinaldo-mendoza.jobsitychallenge.com) 
    ```sh
        $ cd /etc/apache2/sites-available
        $ touch reinaldo-mendoza.jobsitychallenge.com.conf
    ```
    Add the following code in the new file reinaldo-mendoza.jobsitychallenge.com.conf created in the previous step:
    ```xml
        <VirtualHost *:80>
            # The ServerName directive sets the request scheme, hostname and port that
            # the server uses to identify itself. This is used when creating
            # redirection URLs. In the context of virtual hosts, the ServerName
            # specifies what hostname must appear in the request's Host: header to
            # match this virtual host. For the default virtual host (this file) this
            # value is not decisive as it is used as a last resort host regardless.
            # However, you must set it for any further virtual host explicitly.
            ServerName reinaldo-mendoza.jobsitychallenge.com
            ServerAlias reinaldo-mendoza.jobsitychallenge.com
            ServerAdmin rmendoza83@gmail.com
            DocumentRoot /var/www/jobsitychallenge/reinaldo_mendoza/public
    
            <Directory /var/www/jobsitychallenge/reinaldo_mendoza/public>
                Options -Indexes +FollowSymLinks
                Allowoverride All
            </Directory>

            # Available loglevels: trace8, ..., trace1, debug, info, notice, warn,
            # error, crit, alert, emerg.
            # It is also possible to configure the loglevel for particular
            # modules, e.g.
            #LogLevel info ssl:warn

            ErrorLog ${APACHE_LOG_DIR}/reinaldo-mendoza.jobsitychallenge.com_error.log
            CustomLog ${APACHE_LOG_DIR}/reinaldo-mendoza.jobsitychallenge.com_access.log combined
        </VirtualHost>
    ```

4. Enable the new site [reinaldo-mendoza.jobsitychallenge.com](http://reinaldo-mendoza.jobsitychallenge.com) and restart the Apache service: 
    ```sh
        $ a2ensite reinaldo-mendoza.jobsitychallenge.com
        $ sudo /etc/init.d/apache2 restart
        $ cd /var/www/jobsitychallenge/reinaldo_mendoza
    ```

5. Now the folders are configurated for Apache Service, from here we can continue from the step 3 specified in **General Instructions** to get the site working fine.

## Contact
* Reinaldo Mendoza - rmendoza83@gmail.com