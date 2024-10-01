# laravel-visa
Add a VISA to your Laravel Passport, to give SPA's sign-in abilities using Passport ... `work in progress`

Add `CreateFreshApiToken` Middleware from `laravel\passport` add the end of all the `web` middleware, this way a cookie will be added to the responses coming from the back-end.
```php
    /**
     * The application's route middleware groups.
     *
     * @var array
     */
    protected $middlewareGroups = [
        'web' => [
            ...
            \Laravel\Passport\Http\Middleware\CreateFreshApiToken::class,
        ],
```

Get CSRF Cookie before signing in with regular props
```js
    const csrf = () => axios.get('/cookie')
```

Get your csrf cookie before posting to login to acquire a logged-in state
```js
    await csrf()
    await axios.post('/login', [email,password]);
```

Logout is as simple as loggin in:
```js
    await axios.post('/logout');
```

Since CSRF vurnability there's a workaround for posting with `axios`:
```js
import Axios from 'axios'

const axios = Axios.create({
    baseURL: process.env.NEXT_PUBLIC_BACKEND_URL,
    headers: {
        'X-Requested-With': 'XMLHttpRequest',
        'Accept': 'application/json'
    },
    withCredentials: true,
    withXSRFToken: true  //Workaround
})

export default axios
```
