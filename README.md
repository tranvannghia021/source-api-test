### run
- start with xampp
- coppy .env.example -> .env
- In mysql create database with name "api_postman"
- In terminal cd project ->running shell "composer i && php artisan storage:link && php artisan config:cache && php artisan migrate --seed && php artisan serve"