# Selar Backend Test 3


## instructions to start

* clone repo
* composer install
* run redis using `docker run -p 6379:6379 redis`
* make sure you have `QUEUE_CONNECTION=redis` in your `.env` file
* open two terminals
    * in the first one run `php artisan queue:work --daemon`
    * in the second run `php artisan serve`
* visit `http://127.0.0.1:8000/convert`
* you can find the files in `storage_path/converted_videos`

NOTE: I am currently updating this to start using either docker-compose or a makefile
