Apigility Instagram Reverse
===========================

Requirements
------------
  
Please see the [composer.json](composer.json) file.

Installation
------------
Run composer `composer install` to load all deppendecies

Development
-----------
To test this application you can run it with `PHP Built in Web Server`

```
php -S 0.0.0.0:8080 -t public public/index.php
```

Then access it on web browser `http://localhost:8080`, it will redirect to documentation page `http://localhost:8080/apigility/documentation`.

If you want to continue development, you should enable the development mode by rename file `config/development.config.php.dist` to `config/development.config.php`. Then modify the controller file (`module/Application/src/Application/Controller/IndexController.php`) by change this following line

```
return $this->redirect()->toRoute('zf-apigility/documentation');
```

to 

```
return $this->redirect()->toRoute('zf-apigility/welcome');
```