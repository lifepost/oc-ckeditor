<?php

use Backend\Facades\BackendAuth;

/**
 * Filter to Authenticate Backend User
 */
Route::filter('authenticate', function()
{
    if (!BackendAuth::check()) {
        return "You don`t have permission to access this page!!!";
    }
});
