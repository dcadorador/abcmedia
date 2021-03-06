# Sample Application
- This project is similar to a previous worked on, but the base project was using 
Jquery and Laravel. This code version (personal project of mine, to convert to VueJS) is using Laravel API for the back-end and VueJs on the front-end. This is not a full version of the project 
but this will demonstrate a basic CRUD operations and API structure. As I've mentioned this is a personal project of mine
not shared or from a client, I used this code to practice my VueJs skills as well as to improve my Laravel and OOP skills to keep me updated with the new features Laravel has. The goal of this code is to make readable and clean
while trying to use as much functionality from Laravel and VueJs.

#Software
```
Front End - VueJs
Back End - Laravel Api 5.8
PHP - v7.4
MySQL - v5.7
Node - v14.12
```

#Installation

- Install the code repository
```
$ git clone <repo>
```

- Run composer install
```
$ cd <project folder>
$ composer install
```

- Run artisan migrate
```
$ php artisan migrate
```

- Run database seeder
```
$ php artisan db:seed
```

- Generate application keys
```
$ php artisan key:generate
$ php artisan jwt:secret
```

- Run NPM install
```
$ npm install
$ npm run prod
```

- Start Application
```
$ php artisan serve
```

# Credentials
```
email: admin@application.com
passwd: password
```

# Authentication
```
- This project is using a simple JWT token authentication using the package https://github.com/tymondesigns/jwt-auth.
```

# Back-end Design Principles
```
 1. Model Repositories (App\Repositories) - model repositories are created to separate the logic from the models, and simplify the code inside the controllers.

 2. Eloqeunt API Resources (App\Http\Resources) - eloquent API resources are also used to have a standard on returning results (if needed) from the api call

 3. Form Request (App\Http\Requests) - uses a simple form requests to handle simple validation, although most validation are being handled in the front-end

 4. API Controller (App\Http\Api) - all api controllers are inside the API folder to seggragate them and versioning can be added if there is a need to. 

```

# VueJS
```
 1. VueJS Router (App\Resources\router.js) - vue router is used to handle routing of the pages for the application, also using the router view to handle the layout for the application.

 2. Axios (App\Resources\http.js) - axios is used to handle all api calls to the back-end application.

 3. Vuex (App\Resources\Store) - implement a simple VueX implementation for the login call.
```

# Application Functionality
```
 1. Login / Registration
        - simple login using email and password, also with the basic registration

 2. Add New Application Accounts 
        - application will auto-generate a key and logs for the application in the back-end

 3. Dashboard 
        - show the list of accounts existing (can delete and account)
        - show log list for the specific account

 4. Edit Profile
        - added a simple password update
```

# ENV FILE SAMPLE
- Please take note that APP_URL and MIX_APP_URL are important for the VueJS to read the API properly, change these values accordingly to your setup
```
APP_NAME=Laravel
APP_ENV=local
APP_KEY=base64:uITjejaBolbo53IoMucISkkVHx+HNXDx7hw/aRozPec=
APP_DEBUG=true
APP_URL=http://127.0.0.1/
MIX_APP_URL=http://127.0.0.1:8000

LOG_CHANNEL=stack

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=abdmedia
DB_USERNAME=root
DB_PASSWORD=root

BROADCAST_DRIVER=log
CACHE_DRIVER=file
QUEUE_CONNECTION=sync
SESSION_DRIVER=file
SESSION_LIFETIME=120

REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_DRIVER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null

AWS_ACCESS_KEY_ID=
AWS_SECRET_ACCESS_KEY=
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=

PUSHER_APP_ID=
PUSHER_APP_KEY=
PUSHER_APP_SECRET=
PUSHER_APP_CLUSTER=mt1

MIX_PUSHER_APP_KEY="${PUSHER_APP_KEY}"
MIX_PUSHER_APP_CLUSTER="${PUSHER_APP_CLUSTER}"

JWT_SECRET=QeB6lpjYs9n6idVtA8SRNdnXM9Tp1S3Oi3ntqeVD4hbPzkqSjsIAL7zCXx7BHiz9

```
