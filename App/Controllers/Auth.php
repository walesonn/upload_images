<?php

namespace App\Controllers;

use App\Models\Connection;
use App\Models\User;
use Exception;

final class Auth extends Connection{

    public static function login(User $user)
    {
        static::validate($user);
    }

    private static function validate(User $user)
    {   
        try {
            $sql = static::connect()->prepare(
                "SELECT * FROM users WHERE email = :email and senha = :senha"
            );
            $sql->bindValue(":email",$user->getEmail());
            $sql->bindValue(":senha",$user->getSenha());

            $sql->execute();
            if($sql->rowCount() > 0)
            {
                $_SESSION['login'] = true;
                $_SESSION['email'] = $user->getEmail();
                return true;
            }
            return false;

        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}