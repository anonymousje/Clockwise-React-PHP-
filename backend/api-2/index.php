<?php
//  Main router (front controller)

// $request = $_SERVER['REQUEST_URI'];
// $method = $_SERVER['REQUEST_METHOD'];

// if ($request === '/api/users' && $method === 'POST') {
//     require_once __DIR__ . '/controllers/add_user.php';
// }

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
/*
// index.php
require_once 'config/db.php';
require_once 'models/User.php';
require_once 'models/UserRoles.php';
require_once 'models/UserTokens.php';
require_once 'models/Hydrators/UserHydrator.php';
require_once 'models/Mappers/UserMapper.php';
require_once 'services/UserService.php';
require_once 'UseCase/LoginUser.php';
require_once 'controllers/UserController.php';
require_once 'factories/UserFactory.php';

UserFactory::handleRequest($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD'], $pdo);

*/


// require __DIR__ . '/vendor/autoload.php';

// use App\api\Modules\Login\Factories\UserFactory;

// UserFactory::handleRequest($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);



//require __DIR__ . '/autoload.php';

// /var/www/clockwise/api-2/index.php





// // This is the ONLY autoloader you should need for Composer-managed classes.
// require __DIR__ . '/vendor/autoload.php';

// // Now you can use your classes with their correct namespaces
// use App\Modules\Login\Factories\UserFactory;

// echo "Handling request: " . $_SERVER['REQUEST_URI'] . " with method: " . $_SERVER['REQUEST_METHOD'] . "\n";

// UserFactory::handleRequest($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);





// This is the main entry point for your API.
// It loads Composer's autoloader, sets up the application, and dispatches the request.

// 1. Load Composer's autoloader
// This file automatically handles all PSR-4 (and other) autoloading rules defined in composer.json
require __DIR__ . '/vendor/autoload.php';

// Import necessary classes using their namespaces
use App\Config\DB;
use App\Modules\Login\Models\Mappers\UserMapper;
use App\Modules\Login\Services\UserService;
use App\Modules\Login\UseCases\LoginUser;
use App\Modules\Login\Controllers\UserController;
use App\Modules\Login\LoginApiHandler; // The renamed handler class

// // Set default content type for all responses to JSON
// header('Content-Type: application/json');

// // Handle CORS (Cross-Origin Resource Sharing) for local development
// // In production, you would restrict these origins and methods.
// header("Access-Control-Allow-Origin: *");
// header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
// header("Access-Control-Allow-Headers: Content-Type, Authorization");

// Handle preflight OPTIONS requests for CORS
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

try {
    // 2. Initialize Database Connection (Dependency)
    // We get the PDO instance. This might throw a PDOException if connection fails.
    $pdo = DB::getPDO();

    // 3. Wire up dependencies (Dependency Injection)
    // Instantiate classes in the correct order, passing their dependencies.
    $userMapper   = new UserMapper($pdo);
    $userService  = new UserService($userMapper);
    $loginUseCase = new LoginUser($userService);
    $userController = new UserController($loginUseCase);
    $apiHandler   = new LoginApiHandler($userController); // Inject the controller into the handler

    // 4. Get the request URI and method
    $requestUri    = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $requestMethod = $_SERVER['REQUEST_METHOD'];

    // 5. Dispatch the request
    // The handler determines which action to take based on URI and method.
    $apiHandler->handleRequest($requestUri, $requestMethod);

} catch (PDOException $e) {
    // Catch database connection errors specifically
    http_response_code(500); // Internal Server Error
    echo json_encode(['message' => 'Database connection error', 'details' => $e->getMessage()]);
    // Log the full error for debugging (e.g., in a server log file)
    error_log("PDOException caught in index.php: " . $e->getMessage() . " Stack: " . $e->getTraceAsString());
} catch (Exception $e) {
    // Catch any other general exceptions
    http_response_code(500); // Internal Server Error
    echo json_encode(['message' => 'An unexpected server error occurred.', 'details' => $e->getMessage()]);
    // Log the full error for debugging
    error_log("General Exception caught in index.php: " . $e->getMessage() . " Stack: " . $e->getTraceAsString());
}

exit(); // Ensure no further output after response is sent