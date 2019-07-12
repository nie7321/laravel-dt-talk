# Demo App for Laravel DT.n Examples
This is a demo Laravel app. You may need to uncomment a bunch of stuff to get the examples fully working -- this is an intentional thing, as my repo is intended to be used to give the talk :grin:

But if you want to get everything running, clone the repo onto a host with PHP 7.1+, composer, node, and yarn (Homestead works great for this!):

```
cd demo-app
composer install
php artisan key:generate

# Edit .env and add your DB name/user/password w/ your editor of choice
vi .env

php artisan migrate:fresh --seed
yarn install
yarn run dev
```

You should be able to open the app now!
