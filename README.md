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
