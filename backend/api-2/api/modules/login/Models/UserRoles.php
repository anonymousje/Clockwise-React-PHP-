<?php

class UserRole {
    private int $roleId;
    private string $roleName;

    public function getRoleId(): int { return $this->roleId; }
    public function setRoleId(int $roleId): void { $this->roleId = $roleId; }

    public function getRoleName(): string { return $this->roleName; }
    public function setRoleName(string $roleName): void { $this->roleName = $roleName; }
}