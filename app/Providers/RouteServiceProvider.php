<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';
    protected $admin_namespace = 'App\Http\Controllers\Admin';
    protected $owner_namespace = 'App\Http\Controllers\Owner';
    protected $user_namespace = 'App\Http\Controllers\User';

    /**
     * The path to the "home" route for your application.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * Static Pages
     */
    public const USER_ABOUT = "users.static.about";
    public const USER_FAQ = "users.static.faq";
    public const USER_FEEDBACK = "users.static.feedback";
    public const USER_PRIVACY = "users.static.privacy";
    public const USER_TERMS = "users.static.terms";
    public const USER_TESTIMONY = "users.static.testimony";

    public const USER_404 = "users.static.404";
    public const USER_ERROR = "users.static.error";
    public const USER_SUCCESS = "users.static.success";


    /**
     * Auth Pages
     */
    public const USER_LOGIN = "users.auth.login";
    public const USER_LOGOUT = "users.auth.logout";

    public const USER_ACTIVATE = "users.auth.activate";
    public const USER_REGISTER = "users.auth.register";

    public const USER_ACTIVATED = "users.auth.activated";

    public const USER_PASSWORD_CONFIRM = "users.auth.passwords.confirm";
    public const USER_PASSWORD_RESET = "users.auth.passwords.reset";
    public const USER_PASSWORD_REQUEST = "users.auth.passwords.request";
    public const USER_PASSWORD_VERIFY = "users.auth.passwords.verify";


    /**
     * Profile
     */
    public const USER_PROFILE = "users.profile.profile";
    public const USER_PROFILE_EDIT = "users.profile.edit-profile";


    /**
     * User Activities
     */
    // public const USER_INDEX = "users.index";
    public const USER_DASHBOARD = "users.dashboard";
    public const USER_NEWS = "users.news-page";
    public const USER_NOTIFICATIONS = "users.notifications";


    /**
     * Responses
     */
    public const ERROR_PLAIN = "users.response.err_plain";
    public const ERROR_MESSAGE = "users.response.err_message";
    public const GOOD_PLAIN = "users.response.good_plain";



    /**
     * Admin Pages
     */
    public const ADMIN_SUMMARY = "admin.summary";
    public const ADMIN_PAYOUT = "admin.payouts";
    public const ADMIN_AUDIT = "admin.audit";
    public const ADMIN_FAQ = "admin.faq";

    

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        //

        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();
        
        $this->mapAuthUserRoutes();
        
        $this->mapAdminRoutes();
        
        $this->mapOwnerRoutes();

        $this->mapWebRoutes();
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/web.php'));
    }

    /**
     * Define the "Administrators Routes" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapAdminRoutes()
    {
        Route::middleware(['web','is_admin'])
            ->prefix('admin')
            ->namespace($this->admin_namespace)
            ->group(base_path('routes/admin.php'));
    }

    /**
     * Define the "Owners Routes" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapOwnerRoutes()
    {
        Route::middleware(['web','is_owner'])
            ->prefix('owner')
            ->namespace($this->owner_namespace)
            ->group(base_path('routes/owner.php'));
    }

    /**
     * Define the "Routes for Authenticated, Verified And Activated User Accounts" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapAuthUserRoutes()
    {
        Route::middleware(['web','verified', 'activated'])
            ->prefix('user')
            ->namespace($this->user_namespace)
            ->group(base_path('routes/user.php'));
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::prefix('api')
            ->middleware('api')
            ->namespace($this->namespace)
            ->group(base_path('routes/api.php'));
    }
}
