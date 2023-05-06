<h2>🎥Video resume : <a href="https://youtu.be/"> https://youtu.be/ </a></h2>


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