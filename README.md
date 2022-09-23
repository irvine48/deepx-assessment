## Installation

Clone the repository

    git clone git@github.com:irvine48/deepx-code-review.git

Switch to the repo folder

    cd deepx-code-review

Install all the dependencies using composer & npm

    npm install && composer install

Build Vue and Inertia dependencies using Vite

    npm run build

Copy the example env file and make the required configuration changes in the .env file

    cp .env.example .env

Generate a new application key

    php artisan key:generate

Cache Config

    php artisan config:cache

Run the database migrations (**Set the database connection in .env before migrating**)

    php artisan migrate --seed

Run development server or host it in homestead

    php artisan serve

Navigate to Index Route

    **http://127.0.0.1:8000/vue**
