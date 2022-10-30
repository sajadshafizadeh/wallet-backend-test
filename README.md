## Wallet Service

This service provides APIs for user's wallet.


### Installation & Getting started steps:

1. Download the project
2. Run `composer install`
3. Make a databased named "wallet_backend_test" manually
4. Setup the database credentials inside the `.env` file
5. Run `php artisan migrate`
6. Run `php artisan db:seed`
7. Run `php artisan key:generate`
8. Run `php artisan serve --port=8000`
9. Run `php artisan test` and make sure to see all tests passed successfully (green colored)


Now, it would be available through: http://localhost=8000

------------------

Won't be used, just FYI, default user's credentials:

- Username: `test@test.com`
- Password: `1234560!`

------------------

> Note: I will use a constant (hard-codded) token as "servise auth". 

------------------

A self-defined command (used inside the daily cron job):

    php artisan total:amount

------------------

Postman API collection exists at:

    wallet-backend-test\storage\api-collections

------------------

Since some require docker-images were not exist on my local machine, and I'm not able to get them from the docker hub repo (because of some Iran's Government internet restrictions at the moment), I just blindly added Dockerfile and docker-compose.yaml files on the project root (not tested):

![alt text](http://url/to/img.png)

So, you would need something like Xampp, Wamp or a virtual-machine, PHP & MySQL installed on to be able investigate the test.