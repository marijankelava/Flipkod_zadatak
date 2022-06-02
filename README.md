# Flipkod Zadatak

This simple app calculates circumference and area of circle and triangle

## Installation

Clone repository `git clone https://gitlab.com/marijan-kelava/flipkod_zadatak.git`
Enter to project folder `cd your-project-name`
Checkout master branch

## Docker Setup
 - create docker-compose.yml and copy contents of docker-compose.yml.dist
 - build docker containers `docker-compose build`
 - run `docker-compose up -d` to build up the containers 
 - login to `flipkod_zadatak_web` container `docker exec -it flipkod_zadatak_web bash` 
 - run commands:
    `composer install` ,
    `php bin/console do:sc:dr --force`,
    `php bin/console do:sc:cr`,
    `php bin/console assets:install`


## Default database credentials:
 - server: flipkod_zadatak_db
 - username: user
 - password: user
 - database: db

## Request URL
http://localhost:8888/history/circle/{id}
http://localhost:8888/history/triangle/{id}

## Request URL (create method)
http://localhost:8888/circle?radius=3
http://localhost:8888/triangle?a=4&b=5&c=6


## Sample Response
JSON
{ "type": "cicrcle", "radius": "3" "circumference": "12" "area": "10" }






