Getting started
=

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
