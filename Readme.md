### Letöltés

git clone https://github.com/kizmanj/nevnap_api.git

### Inditás
cd nevnap_api  
docker-compose up -d  

## Első inditás után
docker exec -it nevnap_api_php_1 bash -c "cd /code && composer install && composer dump-autoload"  

### Fájl importálása az adatbázisba
docker exec -it nevnap_api_php_1 php /code/index.php Import /code/feladat/nevnapok.html

### Api elérés
http://localhost:8888/api/nameday/2018-11-11
