# Installation


0. Clone repo and cd to project dir:
    - git clone https://github.com/olshevsky/farm.git
    - cd ./farm

1. Run:
   - mkdir vendor
   - make sure ./vendor folder has write permissions
   - docker run --rm -u "$(id -u):$(id -g)" -v "$(pwd):/var/www/html" -w /var/www/html laravelsail/php81-composer:latest composer install --ignore-platform-reqs
    
2. Make sure that ./storage folder has write permissions

3. Run:
    - ./vendor/bin/sail up -d
   
4. Run:
    - docker ps
    - Copy sail-8.1/app CONTAINER ID

5. Login into app container: 
    - docker exec -it {CONTAINER ID} /bin/sh

6. Install dependencies, build assets, create storage symlink and run migrations:
    - composer install
    - php artisan migrate
    - php artisan db:seed
    - php artisan storage:link
    - npm install
    - npm run build
    
7. Restart docker and run:
    - docker exec -it {CONTAINER ID} /bin/sh
    - npm run dev 
    
8. Urls:
   - App: http://localhost
        - admin@localhost/admin
        - user@localhost/user
       
   - PhpMyadmin: http://localhost:8080
       - root/password
