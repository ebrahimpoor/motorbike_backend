# Installation

1- composer install
```bash
	$ composer install
```
2- set your database information in local.php file <br/>
3- create your database <br/>
4- create your tables
```bash
	$ php vendor/bin/doctrine-module orm:schema-tool:create
```

## Running Unit Tests

  ```bash
  $ ./vendor/bin/phpunit --testsuite ApiTest
  ```
