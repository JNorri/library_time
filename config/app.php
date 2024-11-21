<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Application Name
    |--------------------------------------------------------------------------
    |
    | This value is the name of your application, which will be used when the
    | framework needs to place the application's name in a notification or
    | other UI elements where an application name needs to be displayed.
    |
    */

    'name' => env('APP_NAME', 'Laravel'),

    /*
    |--------------------------------------------------------------------------
    | Application Environment
    |--------------------------------------------------------------------------
    |
    | This value determines the "environment" your application is currently
    | running in. This may determine how you prefer to configure various
    | services the application utilizes. Set this in your ".env" file.
    |
    */

    'env' => env('APP_ENV', 'production'),

    /*
    |--------------------------------------------------------------------------
    | Application Debug Mode
    |--------------------------------------------------------------------------
    |
    | When your application is in debug mode, detailed error messages with
    | stack traces will be shown on every error that occurs within your
    | application. If disabled, a simple generic error page is shown.
    |
    */

    'debug' => (bool) env('APP_DEBUG', false),

    /*
    |--------------------------------------------------------------------------
    | Application URL
    |--------------------------------------------------------------------------
    |
    | This URL is used by the console to properly generate URLs when using
    | the Artisan command line tool. You should set this to the root of
    | the application so that it's available within Artisan commands.
    |
    */

    'url' => env('APP_URL', 'http://localhost'),

    /*
    |--------------------------------------------------------------------------
    | Application Timezone
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default timezone for your application, which
    | will be used by the PHP date and date-time functions. The timezone
    | is set to "UTC" by default as it is suitable for most use cases.
    |
    */

    'timezone' => env('APP_TIMEZONE', 'UTC'),

    /*
    |--------------------------------------------------------------------------
    | Application Locale Configuration
    |--------------------------------------------------------------------------
    |
    | The application locale determines the default locale that will be used
    | by Laravel's translation / localization methods. This option can be
    | set to any locale for which you plan to have translation strings.
    |
    */

    'locale' => env('APP_LOCALE', 'en'),

    'fallback_locale' => env('APP_FALLBACK_LOCALE', 'en'),

    'faker_locale' => env('APP_FAKER_LOCALE', 'en_US'),

    /*
    |--------------------------------------------------------------------------
    | Encryption Key
    |--------------------------------------------------------------------------
    |
    | This key is utilized by Laravel's encryption services and should be set
    | to a random, 32 character string to ensure that all encrypted values
    | are secure. You should do this prior to deploying the application.
    |
    */

    'cipher' => 'AES-256-CBC',

    'key' => env('APP_KEY'),

    'previous_keys' => [
        ...array_filter(
            explode(',', env('APP_PREVIOUS_KEYS', ''))
        ),
    ],

    /*
    |--------------------------------------------------------------------------
    | Maintenance Mode Driver
    |--------------------------------------------------------------------------
    |
    | These configuration options determine the driver used to determine and
    | manage Laravel's "maintenance mode" status. The "cache" driver will
    | allow maintenance mode to be controlled across multiple machines.
    |
    | Supported drivers: "file", "cache"
    |
    */

    'maintenance' => [
        'driver' => env('APP_MAINTENANCE_DRIVER', 'file'),
        'store' => env('APP_MAINTENANCE_STORE', 'database'),
    ],

];








// Мой sanctum.php:<?php

// use Laravel\Sanctum\Sanctum;

// return [

//     /*
//     |--------------------------------------------------------------------------
//     | Stateful Domains
//     |--------------------------------------------------------------------------
//     |
//     | Requests from the following domains / hosts will receive stateful API
//     | authentication cookies. Typically, these should include your local
//     | and production domains which access your API via a frontend SPA.
//     |
//     */

//     'stateful' => explode(',', env('SANCTUM_STATEFUL_DOMAINS', sprintf(
//         '%s%s%s',
//         'localhost,localhost:3000,127.0.0.1,127.0.0.1:3000,127.0.0.1:8000,::1',
//         Sanctum::currentApplicationUrlWithPort(),
//         env('FRONTEND_URL') ? ','.parse_url(env('FRONTEND_URL'), PHP_URL_HOST) : ''
//     ))),

//     /*
//     |--------------------------------------------------------------------------
//     | Sanctum Guards
//     |--------------------------------------------------------------------------
//     |
//     | This array contains the authentication guards that will be checked when
//     | Sanctum is trying to authenticate a request. If none of these guards
//     | are able to authenticate the request, Sanctum will use the bearer
//     | token that's present on an incoming request for authentication.
//     |
//     */

//     'guard' => ['web'],

//     /*
//     |--------------------------------------------------------------------------
//     | Expiration Minutes
//     |--------------------------------------------------------------------------
//     |
//     | This value controls the number of minutes until an issued token will be
//     | considered expired. This will override any values set in the token's
//     | "expires_at" attribute, but first-party sessions are not affected.
//     |
//     */

//     'expiration' => null,

//     /*
//     |--------------------------------------------------------------------------
//     | Token Prefix
//     |--------------------------------------------------------------------------
//     |
//     | Sanctum can prefix new tokens in order to take advantage of numerous
//     | security scanning initiatives maintained by open source platforms
//     | that notify developers if they commit tokens into repositories.
//     |
//     | See: https://docs.github.com/en/code-security/secret-scanning/about-secret-scanning
//     |
//     */

//     'token_prefix' => env('SANCTUM_TOKEN_PREFIX', ''),

//     /*
//     |--------------------------------------------------------------------------
//     | Sanctum Middleware
//     |--------------------------------------------------------------------------
//     |
//     | When authenticating your first-party SPA with Sanctum you may need to
//     | customize some of the middleware Sanctum uses while processing the
//     | request. You may change the middleware listed below as required.
//     |
//     */

//     'middleware' => [
//         'authenticate_session' => Laravel\Sanctum\Http\Middleware\AuthenticateSession::class,
//         'encrypt_cookies' => Illuminate\Cookie\Middleware\EncryptCookies::class,
//         'validate_csrf_token' => Illuminate\Foundation\Http\Middleware\ValidateCsrfToken::class,
//     ],

// ];

// // app.php:
// // <?php

// // return [

// //     /*
// //     |--------------------------------------------------------------------------
// //     | Application Name
// //     |--------------------------------------------------------------------------
// //     |
// //     | This value is the name of your application, which will be used when the
// //     | framework needs to place the application's name in a notification or
// //     | other UI elements where an application name needs to be displayed.
// //     |
// //     */

// //     'name' => env('APP_NAME', 'Laravel'),

// //     /*
// //     |--------------------------------------------------------------------------
// //     | Application Environment
// //     |--------------------------------------------------------------------------
// //     |
// //     | This value determines the "environment" your application is currently
// //     | running in. This may determine how you prefer to configure various
// //     | services the application utilizes. Set this in your ".env" file.
// //     |
// //     */

// //     'env' => env('APP_ENV', 'production'),

// //     /*
// //     |--------------------------------------------------------------------------
// //     | Application Debug Mode
// //     |--------------------------------------------------------------------------
// //     |
// //     | When your application is in debug mode, detailed error messages with
// //     | stack traces will be shown on every error that occurs within your
// //     | application. If disabled, a simple generic error page is shown.
// //     |
// //     */

// //     'debug' => (bool) env('APP_DEBUG', false),

// //     /*
// //     |--------------------------------------------------------------------------
// //     | Application URL
// //     |--------------------------------------------------------------------------
// //     |
// //     | This URL is used by the console to properly generate URLs when using
// //     | the Artisan command line tool. You should set this to the root of
// //     | the application so that it's available within Artisan commands.
// //     |
// //     */

// //     'url' => env('APP_URL', 'http://localhost'),

// //     /*
// //     |--------------------------------------------------------------------------
// //     | Application Timezone
// //     |--------------------------------------------------------------------------
// //     |
// //     | Here you may specify the default timezone for your application, which
// //     | will be used by the PHP date and date-time functions. The timezone
// //     | is set to "UTC" by default as it is suitable for most use cases.
// //     |
// //     */

// //     'timezone' => env('APP_TIMEZONE', 'UTC'),

// //     /*
// //     |--------------------------------------------------------------------------
// //     | Application Locale Configuration
// //     |--------------------------------------------------------------------------
// //     |
// //     | The application locale determines the default locale that will be used
// //     | by Laravel's translation / localization methods. This option can be
// //     | set to any locale for which you plan to have translation strings.
// //     |
// //     */

// //     'locale' => env('APP_LOCALE', 'en'),

// //     'fallback_locale' => env('APP_FALLBACK_LOCALE', 'en'),

// //     'faker_locale' => env('APP_FAKER_LOCALE', 'en_US'),

// //     /*
// //     |--------------------------------------------------------------------------
// //     | Encryption Key
// //     |--------------------------------------------------------------------------
// //     |
// //     | This key is utilized by Laravel's encryption services and should be set
// //     | to a random, 32 character string to ensure that all encrypted values
// //     | are secure. You should do this prior to deploying the application.
// //     |
// //     */

// //     'cipher' => 'AES-256-CBC',

// //     'key' => env('APP_KEY'),

// //     'previous_keys' => [
// //         ...array_filter(
// //             explode(',', env('APP_PREVIOUS_KEYS', ''))
// //         ),
// //     ],

// //     /*
// //     |--------------------------------------------------------------------------
// //     | Maintenance Mode Driver
// //     |--------------------------------------------------------------------------
// //     |
// //     | These configuration options determine the driver used to determine and
// //     | manage Laravel's "maintenance mode" status. The "cache" driver will
// //     | allow maintenance mode to be controlled across multiple machines.
// //     |
// //     | Supported drivers: "file", "cache"
// //     |
// //     */

// //     'maintenance' => [
// //         'driver' => env('APP_MAINTENANCE_DRIVER', 'file'),
// //         'store' => env('APP_MAINTENANCE_STORE', 'database'),
// //     ],

// // ];
