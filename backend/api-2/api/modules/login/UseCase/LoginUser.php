<?php
namespace App\Modules\Login\UseCases;

use App\Modules\Login\Services\UserService;

class LoginUser {
    private UserService $userService;

    public function __construct(UserService $userService) {
        $this->userService = $userService;
    }

    public function execute(array $data): array {
        $user = $this->userService->login($data['email'], $data['password']);
        if ($user) {
            $token = bin2hex(random_bytes(16));
            return ['success' => true, 'user_id' => $user->getId(), 'token' => $token];
        }
        return ['success' => false, 'message' => 'Invalid credentials'];
    }
}