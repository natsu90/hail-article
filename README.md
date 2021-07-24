
## Hail-Article

<img width="1280" alt="Screenshot 2021-07-25 at 12 34 04 AM" src="https://user-images.githubusercontent.com/1425214/126869054-f8594cad-e62b-4194-88bb-e33f35a2bf8c.png">


### Prerequisites

* Hail.to account

### Installation

1. `cp .env.example .env`

2. Fill up `CLIENT_ID` & `CLIENT_SECRET` from Hail.to account

3. `composer install`

4. `php artisan key:generate`

5. Publish using `php artisan serve`, or Homestead in my case

6. Set Redirect URI in Hail.to account to `https://your-url/callback`

### Tests

```
vendor/bin/phpunit
```

#### License

Licensed under the [MIT license](http://opensource.org/licenses/MIT)
