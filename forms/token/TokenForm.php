<?php

namespace app\forms\token;

use Yii;
use yii\web\Request;

class TokenForm
{
    private int $_expiresAt;
    private string $_ip;
    private string $_refreshToken;
    private string $_token;
    private string $_userAgent;

    public function __construct(Request $request)
    {
        // Generate and set token string
        $this->generateToken();

        // Generate and set refresh token string
        $this->generateRefreshToken();

        // Set user's ip
        $this->setIp($request->getUserIP());

        // Set user agent data
        $this->setUserAgent($request->getUserAgent());

        // Set token expiration date
        $this->setExpiresAt(time() + Yii::$app->params['secondsToAccessTokenExpires']);
    }

    public function generateToken()
    {
        $this->setToken(Yii::$app->security->generateRandomString());
    }

    public function generateRefreshToken()
    {
        $this->setRefreshToken(Yii::$app->security->generateRandomString());
    }

    public function getToken(): string
    {
        return $this->_token;
    }

    public function setToken($token): void
    {
        $this->_token = (string)$token;
    }

    public function getRefreshToken(): string
    {
        return $this->_refreshToken;
    }

    public function setRefreshToken($refreshToken): void
    {
        $this->_refreshToken = (string)$refreshToken;
    }

    public function getIp(): string
    {
        return $this->_ip;
    }

    public function setIp($ip): void
    {
        $this->_ip = (string)$ip;
    }

    public function getUserAgent(): string
    {
        return $this->_userAgent;
    }

    public function setUserAgent($userAgent): void
    {
        $this->_userAgent = (string)$userAgent;
    }

    public function getExpiresAt(): int
    {
        return $this->_expiresAt;
    }

    public function setExpiresAt($expiresAt): bool
    {
        if (is_int($expiresAt)) {
            $this->_expiresAt = $expiresAt;

            return true;
        }

        return false;
    }

    public function getTokenData(): array
    {
        return [
            'token'        => $this->getToken(),
            'refreshToken' => $this->getRefreshToken(),
            'ip'           => $this->getIp(),
            'userAgent'    => $this->getUserAgent(),
            'expiresAt'    => $this->getExpiresAt(),
        ];
    }

    public function getPublicTokenData(): array
    {
        return [
            'token'        => $this->getToken(),
            'refreshToken' => $this->getRefreshToken(),
            'expiresAt'    => $this->getExpiresAt(),
        ];
    }
}