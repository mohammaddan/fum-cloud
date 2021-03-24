docker-compose -f ./docker-compose-dev.yml up -d
docker-compose -f ./docker-compose-dev.yml exec auth-backend php artisan migrate
docker-compose -f ./docker-compose-dev.yml exec auth-backend php artisan db:seed
docker-compose -f ./docker-compose-dev.yml exec doctor-backend php artisan migrate
docker-compose -f ./docker-compose-dev.yml exec doctor-backend php artisan db:seed