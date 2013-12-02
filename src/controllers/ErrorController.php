<?php
namespace App\Controller;

class ErrorController
{
    public function notFoundAction()
    {
        require_once __DIR__ . '/../views/error_notfound.phtml';
    }
}
