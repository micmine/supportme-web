# supportme-web

## General conditions

The goal is to build a support system for companies that want to move away from phone support or reduce it. But who need a stable and fast system. 

A support system for all companies and products.
An easy way to help the customer with problems.

The following objects are to be implemented. There should be users who have further information Users also have login data. Users can be in a group.
These groups can have permissions. Users can be in a chat. There should be predefined messages.

# Test

```bash
php artisan serve --env=dust.local
```

```bash
php artisan dusk --env=dust.local
```


## Manage Team members

use cli
```bash
php artisan tinker
```

Add user to team (required also for every supporter)
```php
Group::where("name", "team")->first()->addUser(User::where("email", "hans@gmail.com")->first())
```

Add user to supportlevel-1
```php
Group::where("name", "supportlevel-1")->first()->addUser(User::where("email", "hans@gmail.com")->first())
```
