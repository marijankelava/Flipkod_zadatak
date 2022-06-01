Symfony Flipkod

This simple app calculates circumference and area of circle and triangle

Installation
cd your-app-folder

Clone repository 'git clone https://gitlab.com/marijan-kelava/flipkod_zadatak.git'

Checkout master branch

Docker Setup
Create docker-compose.yml and copy contents of docker-compose.yml.dist
Build docker containers `docker-compose build`
Run 'docker-compose up -d' to build up the containers (flipkod_zadatak_web/flipkod_zadatak_db/flipkod_zadatak_adm).

After that, login to sf_web container 'docker exec -it flipkod_zadatak_web bash', and run ./setup.sh which will install php dependencies and create db schema.

setup.sh needs to be executable

Default database credentials:
Server: flipkod_zadatak_db
Username: user
Password: user
Database: db

Request URL
http://localhost:8888/history/circle/{id}
http://localhost:8888/history/triangle/{id}

Request URL (create method)
http://localhost:8888/circle?radius=
http://localhost:8888/triangle?a= &b= &c=


Sample Response
JSON
{ "type": "id": "radius": "circumference": "area", }






