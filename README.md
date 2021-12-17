# Project MVC PHP

### Preview
![uml](./preview/shot-1.png?raw=true "shot-1")
![uml](./preview/shot-2.png?raw=true "shot-2")
![uml](./preview/shot-3.png?raw=true "shot-3")
![uml](./preview/shot-4.png?raw=true "shot-4")

## Check And Fix PRS-2

```
./vendor/bin/phpcs -np src

./vendor/bin/phpcbf -np src

```
## Install

### Nginx setting

```
server {
    listen 80;

    server_name your_server_name;

    root your_server_dir/public/;
    include conf.d/includes/restrictions.inc;

    ######################################
    # FPM config
    ######################################
    location ~ \.php$ {
        try_files $uri = 404;
        include fastcgi_params;
        fastcgi_pass  php-80:9000;
        fastcgi_index index.php;
        fastcgi_param  SCRIPT_FILENAME  $document_root$fastcgi_script_name;
        fastcgi_param  SERVER_NAME    $host;
    }

    location / {
        index  index.php index.html index.htm;
        try_files $uri $uri/ /index.php?$args;
    }
   
    include conf.d/includes/assets.inc;
}
```

### Database

- todos.sql on root folder

### ENV

- APP_URL=your_server_name (required)
- APP_NAME=
- DB_HOST= (required)
- DB_USER= (required)
- DB_PASS= (required)
- DB_NAME= (required)
- PLANNING=1
- DOING=2
- COMPLETE=3
- IP_APP For local unit test and fix refuse connection

