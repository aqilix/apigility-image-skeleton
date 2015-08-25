aqilixapi-image
===============

#Images API Handler
This module is purposed to handle image for an API (create/upload, read, update, delete). Use MySQL and Doctrine for ORM. This module is extendable to use another database adapter. Currently this module support these resources.

- POST  /v1.0/image
- GET   /v1.0/image/id
- PATCH /v1.0/image/id
- DEL   /v1.0/image/id

Dependencies
------------
- [doctrine/doctrine-orm-module](https://packagist.org/packages/doctrine/doctrine-orm-module])

Installation
------------
This is a ZF2/Apigility module, so to use it on your ZF2/Apigility project need to add `repositories` and `require` on `composer.json`. This modules is not registered to [packagist](http://packagist.org) yet. So, we must configure the `repositories`.

```
  "repositories": [
    {
      "type": "vcs",
      "url": "git@github.com:aqilix/apigility-image"
    }
  ],
```

```
  "require": {
    .
    .
    .
    "aqilixapi/image": "dev-master"
  }
```

Run `composer update` then enable the module on `config/application.config.php`

```
return array(
    'modules' => array(
       .
       .
       .
       'AqilixAPI\\Image', 
    )
)
```


Configuration
-------------
Because of this module use doctrine/doctrine-orm-module, we just need to configure database credential using doctrine/doctrine-orm-module configuration. I prepare the config file here `config/doctrine.local.php.dst`. Just copy this file to `config/autoload/doctrine.local.php` and change the `connection params` 

```
    'connection' => array(
        'orm_default' => array(
            'driverClass' => 'Doctrine\\DBAL\\Driver\\PDOMySql\\Driver',
            'params' => array(
                'host'     => '127.0.0.1',
                'dbname'   => 'apigility',
                'user'     => 'apigility',
                'password' => 'apigility',
            ),
        ),
    ),
```

After that, we need to configure the `image path`, `thumbnail path`, and `original file path`. The configuration file is here `config/aqilixapi.image.local.php.dist`. Copy this file to `config/autoload/aqilixapi.image.local.php` and adjust these configuration

```
    'images' => array(
        'target' => 'public/images/prefix',
        'thumb_path' => 'public/images/thumbs',
        'ori_path'   => 'public/images/ori'
    ),
```

Make sure those path are writeable by `Web Server`, but if you use `built in web server` for development you don't need to change their permissions.




