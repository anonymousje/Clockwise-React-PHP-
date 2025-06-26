<?php
class LoginResponse {
    public static function success(array $data): string {
        return json_encode(['success' => true] + $data);
    }

    public static function error(string $message): string {
        return json_encode(['success' => false, 'message' => $message]);
    }
}