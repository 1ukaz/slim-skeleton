<?php
// Routes

use App\Controllers\ProfileController;
use App\Controllers\DefaultController;

/**
 * Default Root Route
 */
$app->get('/[{slug}]', DefaultController::class);

/**
 * Route to get a Facebook Information from it's ID
 */
$app->map(['GET'], '/profile/facebook/[{profile_id}]', ProfileController::class);
