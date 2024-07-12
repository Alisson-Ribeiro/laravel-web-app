
## Installing this project to your development enviroment is that simple

## you will need 3 terminals:

### - 1 for 'php artisan seve', it's your application server and must be kept running;
### - 1 terminal for 'php artisan queue:work', also must be kept running to queue jobs;
### - 1 terminal for other commands

## run the following commands in your CLI in the following order:

- git clone project
- cd into project root folder
- composer install
- npm install
- copy '.env-example'
- paste '.env-example' (same directory, root in this case)
- rename '.env-example' to '.env'
- set your database in '.env' file
- set '.env' file with your (SMTP) email service provider info to deliver email after the creation of a new job position

  	- MAIL_MAILER=smtp
  	- MAIL_HOST= // your host
  	- MAIL_PORT=2525
  	- MAIL_USERNAME= // your username
  	- MAIL_PASSWORD= // your password
  
- php artisan migrate
- php artisan db:seed
- php artisan key:generate
- php artisan serve
- php artisan queue:work
