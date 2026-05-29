# PROYECTO_FINAL_DAW

# Para crear el contenedor de docker
 - docker-compose up -d --build
 - docker exec -it laravel_server bash

# Una vez dentro del proyecto configuramos
 - npm install
 - composer install

# Creamos el .env
    APP_NAME=Laravel
    APP_ENV=local
    APP_KEY=base64:1WQhlZIhoCtyJPzDgWowEP/H0wt6PZXjLYHSij4Mud8=
    APP_DEBUG=true
    APP_URL=http://localhost:5081


    APP_LOCALE=en
    APP_FALLBACK_LOCALE=en
    APP_FAKER_LOCALE=en_US

    APP_MAINTENANCE_DRIVER=file
    # APP_MAINTENANCE_STORE=database


    # PHP_CLI_SERVER_WORKERS=4


    BCRYPT_ROUNDS=12


    LOG_CHANNEL=stack
    LOG_STACK=single
    LOG_DEPRECATIONS_CHANNEL=null
    LOG_LEVEL=debug


    DB_CONNECTION=sqlite
    # DB_HOST=db
    # DB_PORT=3306
    # DB_DATABASE=laravel_db
    # DB_USERNAME=root
    # DB_PASSWORD=root


    SESSION_DRIVER=file
    SESSION_LIFETIME=120
    SESSION_ENCRYPT=false
    SESSION_PATH=/
    SESSION_DOMAIN=null


    BROADCAST_CONNECTION=log
    FILESYSTEM_DISK=local
    QUEUE_CONNECTION=database


    CACHE_STORE=database
    # CACHE_PREFIX=


    MEMCACHED_HOST=127.0.0.1


    REDIS_CLIENT=phpredis
    REDIS_HOST=127.0.0.1
    REDIS_PASSWORD=null
    REDIS_PORT=6379


    MAIL_MAILER=log
    MAIL_SCHEME=null
    MAIL_HOST=127.0.0.1
    MAIL_PORT=2525
    MAIL_USERNAME=null
    MAIL_PASSWORD=null
    MAIL_FROM_ADDRESS="hello@example.com"
    MAIL_FROM_NAME="${APP_NAME}"


    AWS_ACCESS_KEY_ID=
    AWS_SECRET_ACCESS_KEY=
    AWS_DEFAULT_REGION=us-east-1
    AWS_BUCKET=
    AWS_USE_PATH_STYLE_ENDPOINT=false


    VITE_APP_NAME="${APP_NAME}"

# Crear el archivo de la base de datos
 - touch database/database.sqlite

# Dar permisos para que Laravel pueda escribir en él
# (Esto es CRUCIAL en Linux para que no de error de "Permission denied")
 - chown www-data:www-data database/database.sqlite
 - chmod 664 database/database.sqlite
 - chown www-data:www-data database/

# Instalamos la dependencia para auth
 - composer require laravel/sanctum 
 - php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider" 
 - Tenemos que irnos a database, migrations y borramos la migracion que se ha creado por defecto

# Hacemos la migracion
 - php artisan migrate:fresh --seed 

# Corremos el proyecto
 - npm run dev