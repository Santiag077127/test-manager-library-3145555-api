<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Authentication Defaults
    |--------------------------------------------------------------------------
    |
    | Phase 1 intentionally has no authentication behavior. A JWT guard will
    | be configured only when the approved authentication adapter is built.
    |
    */

    'defaults' => [
        'guard' => null,
        'passwords' => null,
    ],

    /*
    |--------------------------------------------------------------------------
    | Authentication Guards
    |--------------------------------------------------------------------------
    |
    | The framework's inherited web guard is explicitly disabled so the
    | project does not imply session authentication outside the contract.
    |
    */

    'guards' => [
        'web' => null,
    ],

    /*
    |--------------------------------------------------------------------------
    | User Providers
    |--------------------------------------------------------------------------
    |
    | The inherited Eloquent user provider is disabled. The future security
    | adapter must access users through an application port.
    |
    */

    'providers' => [
        'users' => null,
    ],

    /*
    |--------------------------------------------------------------------------
    | Resetting Passwords
    |--------------------------------------------------------------------------
    |
    | Password reset is outside the approved product scope, so the inherited
    | password broker is explicitly disabled.
    |
    */

    'passwords' => [
        'users' => null,
    ],

    /*
    |--------------------------------------------------------------------------
    | Password Confirmation Timeout
    |--------------------------------------------------------------------------
    |
    | Here you may define the number of seconds before a password confirmation
    | window expires and users are asked to re-enter their password via the
    | confirmation screen. By default, the timeout lasts for three hours.
    |
    */

    'password_timeout' => env('AUTH_PASSWORD_TIMEOUT', 10800),

];
