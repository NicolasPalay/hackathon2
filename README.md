# Create for hackathon 2023

## members : 
- Nicolas PALAY
- ahmed SALEK
- Maxime GONOTEY-GRIMOUX
- Estèphe FATH
- Youssouf ABDULKADER
- Caroline LEBON

### for start the Projet : 
- create .env.local and add your database
- composer install
- yarn install
- yarn build
- symfony console doctrine:database:create
- symfony console doctrine:migrations:migrate
- composer require doctrine/doctrine-fixtures-bundle --dev si besoin
- symfony console doctrine:fixtures:load
- symfony server:start
