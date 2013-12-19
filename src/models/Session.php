<?php
namespace App\Model;

class Session
{
    public function __construct()
    {
        session_start();
    }

    public function generateToken()
    {
        $_SESSION['token'] = bin2hex(openssl_random_pseudo_bytes(32));
    }

    public function getToken()
    {
        return isset($_SESSION['token']) ? $_SESSION['token'] : null;
    }

    public function validateToken($token)
    {
        $valid = $this->getToken() === $token;
        unset($_SESSION['token']);
        return $valid;
    }

    public function getQuoteId()
    {
        return isset($_SESSION['quote_id']) ? $_SESSION['quote_id'] : null;
    }

    public function setQuoteId($id)
    {
        $_SESSION['quote_id'] = $id;
    }
}