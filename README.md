Getting started
=
Appointmind is an [online appointment scheduling](https://www.appointmind.com "Online Appointment Scheduling") service. **appointmind/api** is an API client, written in PHP and using Zend Framework components, that alllows you to create users and appointments, and login users via single sign-on.

Features
-
- Create users
- Create appointments
- Single sign-on

Install with composer
-
```bash
composer require appointmind/api
```

Use
-
```php
$user = new \Appointmind\User();
$user->setUri('...');
$user->setAccessKey('...');
$user->setSecretKey('...');
$result = $user->create([]);
```

Response

```json
{
    "result": {
        "userId": "123456789"
    },
    "error": null,
    "id": 1,
    "jsonrpc": "2.0"
}
```

Login User
-
```php
$user = new \Appointmind\User();
$user->setUri('...');
$user->setAccessKey('...');
$user->setSecretKey('...');
$result = $user->login('info@example.com', $redirect = 'https://www.example.com/redirect/');
```

Response

```json
{
	"result": {
		"token": "2c3373ea2cf25743376fce78ef23383a651654b6802c965aa38ab5fd3b4863a3",
		"url": "https://www.example.com/login/?token=2c3373ea2cf25743376fce78ef23383a651654b6802c965aa38ab5fd3b4863a3&singlesignon=1"
	},
	"error": null,
	"id": 1,
	"jsonrpc": "2.0"
}
```
