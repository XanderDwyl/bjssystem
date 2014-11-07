## BJSMotoshop System - Laravel PHP Framework

[![Build Status](https://travis-ci.org/XanderDwyl/bjssystem.svg)](https://travis-ci.org/XanderDwyl/bjssystem.svg)

BJSMotoshop System is a web application based on Laravel PHP framework. Laravel attempts to take the pain out of development by easing common tasks used in the majority of web projects, such as authentication, routing, sessions, and caching.

This aim to ease the computation of the company financial aspects. Which is accessible, yet a tools needed for a company to compute easily the expenses vs. the sales.

## Installation

- Edit virtual host configuration or create a virtual host

```
- change folder permission
	chmod -R 777 /app/storage/*  --- for mac
```

```
- install composer.json
	composer install
```

```
- install bower.json
	bower install
```

- create a file app/libraries/DbQuery.php
    replace xxxx with your configuration
```
	<?php
		class DbQuery {
			public static function setDBEnv() {
				return array(
					'driver'    => 'mysql',
					'host'      => 'xxxxx',
					'database'  => 'xxxxx',
					'username'  => 'xxxxx',
					'password'  => 'xxxxx',
					'port'      => '3306',
					'charset'   => 'utf8',
					'collation' => 'utf8_unicode_ci',
					'prefix'    => ''
				);
			}

		}
```

### License

The Laravel framework is open-sourced software licensed under the [MIT license](https://github.com/XanderDwyl/bjsaccountingsystem/blob/dev/LICENSE.md)
