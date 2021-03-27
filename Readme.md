# How to run project
### *By run **start.sh**, it will start docker-compose-dev.yml file and then migrate databases, then create fake data.*
One of fake user is :
* username : mohammad
* password : 123456
* role : user
## Start in browser by http://localhost:4000
---
## This project is for practice micro-service model programming
![](https://laravel.com/img/favicon/favicon-32x32.png)
```php
$backend = 'Laravel';
```
![](https://vuejs.org/images/icons/favicon-32x32.png)
```js
let fronend = 'Vuejs';
```
![](https://www.docker.com/favicon.ico)
```bash
$container_service = 'docker'
```
- <div class="text-purple"> backend: Laravel</div>
- <div class="text-green">frontend : Vuejs</div>
- <div class="text-blue">container-service : docker</div>

---
## Class Professor:
* Dr.Saeid Abrishami
## Supervisor:
* Sajad Khosravi
## Group members:
* Mohammad Daneshamooz
* Mahsa Zahedi
---
## **Services** (7 services):
* auth 
    * auth-backend 
    * auth-db
* doctor 
    * doctor-backend
    * doctor-db
* user
    * user-backend
    * user-db
* user-panel
# Database tables for this project:
* ### auth service
    * users
* ### doctor service
    * info
    * work_times
    * visit_times
* ### user service
    * info
    * doctor_comments
    * favorites
    * city

# Some screen shots :
![login](https://api.programai.ir/storage/pubmd/login.png)
![profile](https://api.programai.ir/storage/pubmd/profile.png)
![doctors](https://api.programai.ir/storage/pubmd/doctors.png)
![doctor](https://api.programai.ir/storage/pubmd/doctor.png)


