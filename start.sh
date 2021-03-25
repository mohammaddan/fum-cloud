docker-compose -f ./docker-compose-dev.yml up -d --build

docker-compose -f ./docker-compose-dev.yml exec auth-backend php artisan migrate
docker-compose -f ./docker-compose-dev.yml exec auth-backend php artisan db:seed

docker-compose -f ./docker-compose-dev.yml exec doctor-backend php artisan migrate
docker-compose -f ./docker-compose-dev.yml exec doctor-backend php artisan db:seed

docker-compose -f ./docker-compose-dev.yml exec user-backend php artisan migrate
docker-compose -f ./docker-compose-dev.yml exec user-backend php artisan db:seed