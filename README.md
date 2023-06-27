# Create for hakathon 2023

## members : 
- Nicolas Palay
- ahmed salek
- Maxime Gonotey-Grimoux
- Estèphe Fath
- Youssouf,Soudjay Abdulkader

### for start the Projet : 
- create .env.local and add your database
- composer install
- symfony console doctrine:database:create
- symfony console doctrine:migrations:migrate
- composer require doctrine/doctrine-fixtures-bundle --dev si besoin
- composer require fakerphp/faker soin besoin
- symfony console doctrine:fixtures:load
- symfony server:start
