<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Inbox Domain
    |--------------------------------------------------------------------------
    |
    | This is the subdomain where Inbox will be accessible from. If this
    | setting is null, Inbox will reside under the same domain as the
    | application. Otherwise, this value will serve as the subdomain.
    |
    */

    'domain' => null,

    /*
    |--------------------------------------------------------------------------
    | Inbox Path
    |--------------------------------------------------------------------------
    |
    | This is the URI path where Inbox will be accessible from. Feel free
    | to change this path to anything you like. Note that the URI will not
    | affect the paths of its internal API that aren't exposed to users.
    |
    */

    'inbox_path' => 'inbox',

    /*
    |--------------------------------------------------------------------------
    | Inbox Route Middleware
    |--------------------------------------------------------------------------
    |
    | These middleware will get attached onto each Inbox route, giving you
    | the chance to add your own middleware to this list or change any of
    | the existing middleware. Or, you can simply stick with this list.
    |
    */

    'middleware' => ['web'],

    /*
     * The driver to use when listening for incoming emails.
     * It defaults to the mail driver that you are using.
     *
     * Supported drivers: "log", "mailgun", "sendgrid"
     */
    'driver' => env('MAILBOX_DRIVER', 'log'),

    /*
     * The path for driver specific routes. This is where
     * you need to point your driver specific callbacks
     * to.
     *
     * For example: /laravel-mailbox/sendgrid/
     */
    'path' => 'laravel-mailbox',

    /*
     * The amount of days that incoming emails should be stored in your
     * application. You can use the cleanup artisan command to
     * delete all older inbound emails on a regular basis.
     */
    'store_incoming_emails_for_days' => 7,

    /*
     * By default, this package only stores incoming email messages
     * when they match one of your mailboxes. To store all incoming
     * messages, modify this value.
     */
    'only_store_matching_emails' => true,

    /*
     * Some services do not have their own authentication methods to
     * verify the incoming request. For these services, you need
     * to use this username and password combination for HTTP
     * basic authentication.
     *
     * See the driver specific documentation if it applies to your
     * driver.
     */
    'basic_auth' => [
        'username' => env('MAILBOX_HTTP_USERNAME', 'laravel-mailbox'),
        'password' => env('MAILBOX_HTTP_PASSWORD')
    ],

    /*
     * Third party service configuration.
     */
    'services' => [

        'mailgun' => [
            'key' => env('MAILBOX_MAILGUN_KEY'),
        ],
        'gmail' => [
            'username' => env('GMAIL_USER_NAME'),
            'password' => env('GMAIL_PASSWORD'),
            'fetch' => env('GMAIL_FETCH'),
        ],

    ]

];