# XTUserManagement
# Requirements
1. PHP >=7.1
2. Laravel 8
3. MySql
# Installation
1. git clone repositoryUrl
2. Go to the root folder of the project in terminal
3. Update the .env file using the shared env file via email
4. Run composer install
5. Then run "npm run dev"
# Configuration
1. Super admin credentials can be changed in the env file.
2. I mentioned super admin credentails in .env. There is no registration for super admin.
# Migration
1. create a new database in mysql using, "create database dbName"
2. Once installation is successful, run the migrations using, "php artisan migrate"
3. Then run the seed to create super admin user, "php artisan db:seed --class=RegisterSuperAdmin
4. Once done, run "php artisan serve"
# REST API
# Login 
  1. URL : api/v1/login
  2. Method: POST
  3. Headers : Content-type : application/json
  4. Request : {"email":"ganeshrc35@gmail.com","password":"Qwerty#123"}
  5. Response:      {"status_code":200,"access_token":"eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC8xMjcuMC4wLjE6ODAwMFwvYXBpXC92MVwvbG9naW4iLCJpYXQiOjE2MzEyMTQ5MDEsImV4cCI6MTYzMTIxODUwMSwibmJmIjoxNjMxMjE0OTAxLCJqdGkiOiJKenJna01wOW1xZXhTTnlGIiwic3ViIjoxLCJwcnYiOiI4N2UwYWYxZWY5ZmQxNTgxMmZkZWM5NzE1M2ExNGUwYjA0NzU0NmFhIn0.6HWSlmDQ8DMl0Eq27MZl88gXOYHSdakAZDomkp8jpsU","token_type":"bearer"}

# Get user details
  1. URL : api/v1/getUser
  2. Methos : GET
  3. Headers : Authorization Bearer access_token
  4. Response : 
    {
    "user": {
        "id": 1,
        "name": "super admin",
        "email": "ganeshrc35@gmail.com",
        "username": "super_admin",
        "mobile_number": null,
        "profile_image": "20210909111410-altroziturboaltroziturborightfrontthreequarter.jpeg",
        "address": null,
        "city": null,
        "state": null,
        "country": null,
        "dob": null,
        "created_at": "2021-09-06 18:43:48",
        "updated_at": "2021-09-06 18:43:48",
        "deleted_at": null
    },
    "status_code": 200
  }
 
 # Logout
  1. URL : api/v1/logout
  2. Method : GET
  3. Headers : Authorization Bearer access_token
  4. Response : 
     {
    "status_code": 200,
    "message": "User logged out successfully"
  }
