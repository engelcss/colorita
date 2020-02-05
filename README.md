# Colorita - сервис палитр (backend)

Сервис Colorita был задуман как быстрый проект для рассмотрения нужных нам технологий. Вполне возможно, что мы улучшим функционал и доведем это приложение до стадии полноценного сервиса для подбора цветовых схем. 

## Requirements

* PHP >= 7.2
* OpenSSL PHP Extension
* PDO PHP Extension
* Mbstring PHP Extension
* PostgreSQL or MySQL

## Install
1. git clone ... 
2. [in console] `composer install`
3. [in console] `composer dumpautoload`
4. Copy .env.example as .env 
5. [in console] `php artisan key:generate`
6. Change config in .env (general & database)
7. [in console] `php artisan migrate --seed`
8. ...
9. Enjoy!

#### Note:

You can to start server easily, just use this command from your project's directory 

`php -S localhost:8000 -t public`

and go to http://localhost:8000/

## Docs

GET first 80 palettes:

`http://your.domain/`

GET for 2 page etc.:

`http://your.domain/2`

GET the palette:

`http://your.domain/{url}`

GET generate 1000 palettes if you need more:

`http://your.domain/generate/palettes/please`

POST create palette with your colors:
* Header must be with `Content-type: application/json`
* JSON structure:

```
{"data" : 
    [ 
        { "sort" : "1" , "color" : "e1e1e1" } , 
        { "sort" : "2" , "color" : "f2f2f2" } ,
        ...
    ] 
}
```

`http://your.domain/palette/create`


## License

Таки какая лицензия, Вы шо, у нас все на опенсурсе, вот таки я Вам скажу ссылочку на [MIT license](https://opensource.org/licenses/MIT).
