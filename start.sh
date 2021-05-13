docker-compose up -d --build

docker-compose exec auth-backend php artisan migrate
docker-compose exec auth-backend php artisan db:seed

docker-compose exec doctor-backend php artisan migrate
docker-compose exec doctor-backend php artisan db:seed

docker-compose exec user-backend php artisan migrate
docker-compose exec user-backend php artisan db:seed