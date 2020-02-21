## Installation

Clone the repository

    https://github.com/nirajradadiya/auth.git


Switch to the repo folder

    cd auth

Install all the dependencies using composer

    composer install

Copy the example env file and make the required configuration changes in the .env file

    cp .env.example .env

Import db which is in root folder

    auth_role.sql

Set localhost port 80 to 9090 and restart apache

    You can now access the server at http://localhost:9090/auth 


## Category Front Pages Links

http://localhost:9090/auth/frontpages/category
http://localhost:9090/auth/frontpages/category/add
http://localhost:9090/auth/frontpages/category/edit
http://localhost:9090/auth/frontpages/category/delete


## Product Front Pages Links

http://localhost:9090/auth/frontpages/product
http://localhost:9090/auth/frontpages/product/add
http://localhost:9090/auth/frontpages/product/edit
http://localhost:9090/auth/frontpages/product/delete


## User Login Link

http://localhost:9090/auth/frontpages/login


## Login User Detail

http://localhost:9090/auth/frontpages/userdetail