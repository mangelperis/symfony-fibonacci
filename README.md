## About Fibonacci

API that allows to generate fibonacci numbers given a range of dates

## Infrastructure used
* Symfony 5.3 
* PHP 8.0
* Nginx
* Docker

## Third party libraries
* twig
* phpunit

## Installation
Extract the zip files or clone the repository in your desired folder and then open a console window there.
Install required dependencies with
> cd src/ && composer install

The docker and project files are located in different folders so in order to start the container:
> cd docker/ && docker-compose up -d --build

Done!

## How it works ?

Once the container is up you can check all is OK going to the following addres (by default):
> http://localhost/

You'll see the current Symfony version in a welcome page.

Use Postman or another cli in order to perform actions to the API endpoint.

The list of available endpoints can be shown executing (while your logged inside the container) with:
> bin/console debug:router

These are all the available endpoints:
```
GET       api/numbers                  Given a range of dates, generate fibonacci numbers between it
```

HTML form is available to input the dates and display the result in a browser here:
```
/app/form
 ```

Additionally, run all the tests available using:
>cd src/ && bin/phpunit
