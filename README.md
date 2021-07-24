
## Hail-Article

### Prerequisites

* Hail.to account

### Installation

1. `cp .env.example .env`

2. Fill up `CLIENT_ID` & `CLIENT_SECRET` from Hail.to account

3. `composer install`

4. Publish using `php artisan serve`, or Homestead in my case

5. Set Redirect URI in Hail.to account to `https://your-url/callback`

### Tests

```
vendor/bin/phpunit
```

#### License

Licensed under the [MIT license](http://opensource.org/licenses/MIT)