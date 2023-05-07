<h2>🎥Video resume : <a href="https://www.youtube.com/watch?v=CenBylbYY6A&ab_channel=NabilAfkir"> BuddyBeats </a></h2>


## About BuddyBeats

Is a page where you can have all your music streaming services conected. All your playlist in only one place and if is not enough, you can also transfer them from one service to other.

## Analysis
## Design

## Getting Started

### Prerequisites

You need to have installed npm and composer
* npm
  ```sh
  npm install npm@latest -g
  ```
  
* xampp (or other stack like it with apache, mariaDB and php)

<a href="https://www.apachefriends.org/es/index.html">Xampp Download Page</a>

* Composer
```sh
  php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
  php -r "if (hash_file('sha384', 'composer-setup.php') === '906a84df04cea2aa72f40b5f787e49f22d4c2f19492ac310e8cba5b96ac8b64115ac402c8cd292b8a03482574915d1a8') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
  php composer-setup.php
  php -r "unlink('composer-setup.php');"
```

or

<a href="https://getcomposer.org/download/">Composer Download Page</a>
  

### Installation 🚀

1. Clone the repo
   ```sh
     Git clone https://github.com/NabilCopilot/buddybeats
   ```
2. Install NPM packages
   ```
     npm install
   ```
3. Run NPM packages
    ```
        npm run dev
    ```
4. Launch server
   ```
       php artisan serve
   ```
   
5. Create new data base called: buddy_beats

6. Run migrations and seeders
   ```
       php artisan migrate:refresh --seed
   ```

## Tests

Test are locate in the file tests\Feature for the integration test or tests\Unit for unit test. In this case I'm using both of them. To run them use: 
  ```
    php artisan test
  ```
If only wanna run unit tests use this command:
  ```
    ./vendor/bin/phpunit tests/Unit
  ```
Or this command for integration tests:
  ```
    ./vendor/bin/phpunit tests/Feature
  ```

Those packages are also needed to run the test:
  ```
    composer require --dev orchestra/testbench
    composer require --dev nyholm/psr7
    composer require --dev phpunit/phpunit
  ```

## Deploy

I used this website called HEROKU, where you can host your website and database for free with some restriccions. But for this purpose it's enough. The website performance its not the greatnest but it does the job.

<a href="http://sleepy-refuge-45279.herokuapp.com/">Buddy Beats</a>