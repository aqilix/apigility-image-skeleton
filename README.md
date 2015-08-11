Apigility Instagram Reverse
===========================

Requirements
------------
  
Please see the [composer.json](composer.json) file.

Installation
------------

### Via release tarball

Grab the latest release via the [Apigility website](http://apigility.org/)
and/or the [releases page](https://github.com/zfcampus/zf-apigility-skeleton/releases).
At the time of this writing, that URI is:

- https://github.com/zfcampus/zf-apigility-skeleton/releases/download/0.9.1/zf-apigility-skeleton-0.9.1.tgz

Untar it:

```bash
tar xzf zf-apigility-skeleton-0.9.1.tgz
```

### Via Composer (create-project)

You can use the `create-project` command from [Composer](http://getcomposer.org/)
to create the project in one go:

```bash
curl -s https://getcomposer.org/installer | php --
php composer.phar create-project -sdev zfcampus/zf-apigility-skeleton path/to/install
```


REST API DOC
=============

GET  /v1.0/images
POST /v1.0/image
GET  /v1.0/image/id
PUT  /v1.0/image/id
DEL  /v1.0/image/id
