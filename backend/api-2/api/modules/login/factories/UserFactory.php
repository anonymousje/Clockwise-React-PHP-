<?php

// In /var/www/clockwise/api-2/api/modules/login/factories/UserFactory.php
namespace App\Modules\Login\Factories;

use App\Modules\Login\Models\Mappers\UserMapper;
use App\Modules\Login\Services\UserService;
use App\Modules\Login\Controllers\UserController;
use App\Modules\Login\UseCases\LoginUser;
use App\Config\DB; // Use this if DB class is autoloaded

// REMOVE: require_once __DIR__ . '/../../../../Config/db.php';


class UserFactory { // Consider renaming this class
    public static function handleRequest($uri, $method) {
        try {
            // Ensure DB class is properly autoloaded or available
            $pdo = \DB::getPDO(); // Use fully qualified name if DB is global or use 'use' statement

            $userMapper = new UserMapper($pdo);
            $userService = new UserService($userMapper);
            $loginUseCase = new LoginUser($userService);
            $userController = new UserController($loginUseCase);

            if ($uri === '/login' && $method === 'POST') {
                $userController->login();
            } else {
                http_response_code(404);
                echo json_encode(['message' => 'Not Found']);
            }
        } catch (\PDOException $e) {
            // Handle database connection errors gracefully
            http_response_code(500);
            echo json_encode(['message' => 'Database connection error', 'details' => $e->getMessage()]);
            // Log the error for debugging: error_log($e->getMessage());
        } catch (\Exception $e) {
            // Catch any other unexpected errors
            http_response_code(500);
            echo json_encode(['message' => 'An unexpected error occurred', 'details' => $e->getMessage()]);
            // Log the error: error_log($e->getMessage());
        }
    }
}