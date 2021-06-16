## Installation

Clone the repository

    git clone https://github.com/Fypex/testTask.git

Switch to the repo folder

    cd testTask

Install all the dependencies using composer

    composer install

Copy the example env file and make the required configuration changes in the .env file

    cp .env.example .env

Generate a new application key

    php artisan key:generate
    
Set to .env file

    SANCTUM_STATEFUL_DOMAINS=spa.domain.loc
    SESSION_DRIVER=cookie
    SESSION_DOMAIN=.domain.loc
    
    
Run the database migrations

    php artisan migrate

