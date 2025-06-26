<?php
class UserToken {
    private int $tokenId;
    private int $userId;
    private string $jwtToken;
    private string $issuedAt;
    private string $expiresAt;

    public function getTokenId(): int { return $this->tokenId; }
    public function setTokenId(int $tokenId): void { $this->tokenId = $tokenId; }

    public function getUserId(): int { return $this->userId; }
    public function setUserId(int $userId): void { $this->userId = $userId; }

    public function getJwtToken(): string { return $this->jwtToken; }
    public function setJwtToken(string $jwtToken): void { $this->jwtToken = $jwtToken; }

    public function getIssuedAt(): string { return $this->issuedAt; }
    public function setIssuedAt(string $issuedAt): void { $this->issuedAt = $issuedAt; }

    public function getExpiresAt(): string { return $this->expiresAt; }
    public function setExpiresAt(string $expiresAt): void { $this->expiresAt = $expiresAt; }
}