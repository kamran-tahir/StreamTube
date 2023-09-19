<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * These middleware are run during every request to your application.
     *
     * @var array
     */
    protected $middleware = [
        \Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode::class,
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array
     */
    protected $middlewareGroups = [
        'web' => [
            \App\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            // \App\Http\Middleware\VerifyCsrfToken::class,
        ],

        'api' => [
            'throttle:60,1',
        ],
    ];

    /**
     * The application's route middleware.
     *
     * These middleware may be assigned to groups or used individually.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'auth' => \App\Http\Middleware\Authenticate::class,
        'admin' => \App\Http\Middleware\AuthenticateAdmin::class,
        'moderator' => \App\Http\Middleware\AuthenticateModerator::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'can' => \Illuminate\Foundation\Http\Middleware\Authorize::class,
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
        'guestadmin' => \App\Http\Middleware\RedirectIfAuthenticatedAdmin::class,
        'guestmoderator' => \App\Http\Middleware\RedirectIfAuthenticatedModerator::class,
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        'UserApiVal' => \App\Http\Middleware\UserApiValidation::class,
        'NewUserApiVal' => \App\Http\Middleware\NewUserApiValidation::class,
        'PaypalCheck' => \App\Http\Middleware\PaypalCheckMiddleware::class,
        'verifyUser' => \App\Http\Middleware\CheckUserVerification::class,
        'AdminMiddleware' => \App\Http\Middleware\AdminMiddleware::class,
        'SubAdminMiddleware' => \App\Http\Middleware\SubAdminMiddleware::class,
        'ChannelOwner' => \App\Http\Middleware\ChannelOwner::class,
        'ShowSecurityPage' => \App\Http\Middleware\SecurityPageMiddleware::class,
        'ChannelMember' => \App\Http\Middleware\ChannelMember::class,

    ];
}
