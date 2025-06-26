<?php

namespace App\Modules\Login;

use App\Modules\Login\Controllers\UserController;
use Exception; // For general exceptions

class LoginApiHandler
{
    private UserController $userController;

    /**
     * Constructor for LoginApiHandler.
     * Dependencies are injected here.
     *
     * @param UserController $userController The User Controller instance.
     */
    public function __construct(UserController $userController)
    {
        $this->userController = $userController;
    }

    /**
     * Handles incoming API requests and dispatches to the correct controller method.
     *
     * @param string $uri The request URI.
     * @param string $method The request HTTP method.
     */
    public function handleRequest(string $uri, string $method): void
    {
        // Simple routing logic. For a complex app, use a dedicated router library.
        try {
            if ($uri === '/login' && $method === 'POST') {
                $this->userController->login();
            } else {
                http_response_code(404); // Not Found
                echo json_encode(['message' => 'Endpoint Not Found']);
            }
        } catch (Exception $e) {
            // Catch any unexpected exceptions and return a generic server error
            error_log("Unhandled Exception in LoginApiHandler: " . $e->getMessage() . " on line " . $e->getLine() . " in file " . $e->getFile());
            http_response_code(500); // Internal Server Error
            echo json_encode(['message' => 'An internal server error occurred.']);
        }
    }
}