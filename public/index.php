<?php
// Entry point for the application
require_once __DIR__ . '/../bootstrap/app.php';

// Initialize core components
$logger = new App\Core\Logger();
$dbConfig = require __DIR__ . '/../app/config/database.php';
$db = new App\Core\Database($dbConfig, $logger);

// Register services in container
App\Core\App::bind('logger', $logger);
App\Core\App::bind('db', $db);
App\Core\App::bind('userModel', new App\Models\User($db));
App\Core\App::bind('facilityModel', new App\Models\Facility($db));
App\Core\App::bind('imageService', new App\Services\ImageService());
App\Core\App::bind('validator', new App\Core\Validator());
App\Core\App::bind('authService', App\Core\App::make(App\Services\AuthService::class));
App\Core\App::bind('facilityService', App\Core\App::make(App\Services\FacilityService::class));

// Initialize controllers
$authController = App\Core\App::make(App\Controllers\AuthController::class);
$facilityController = App\Core\App::make(App\Controllers\FacilityController::class);

// Initialize router
$router = new App\Core\Router();

// Define routes
$router->get('/', function() {
    echo "Home page";
});

$router->get('/login', [$authController, 'showLogin']);
$router->post('/login', [$authController, 'processLogin']);
$router->get('/logout', [$authController, 'logout']);

$router->get('/admin/facilities', [$facilityController, 'index']);
$router->post('/admin/facilities', [$facilityController, 'store']);
$router->get('/admin/facilities/{id}/edit', [$facilityController, 'edit']);
$router->post('/admin/facilities/{id}/update', [$facilityController, 'update']);
$router->post('/admin/facilities/{id}/delete', [$facilityController, 'delete']);

// Dispatch the request
$router->dispatch();