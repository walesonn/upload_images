<?php

namespace App\Models;

class User extends Model{
    private $email;
    private $senha;

    public function __construct(string $email,string $senha)
    {
        $this->email = $email;
        $this->senha = $senha;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getSenha()
    {
        return $this->senha;
    }
}