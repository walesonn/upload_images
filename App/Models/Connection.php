<?php

namespace App\Models;

use PDO;
use PDOException;

abstract class Connection{
    
    public static function connect()
    {
        try{
            return new PDO(DB_HOST,USER_DB,PWD);
        }catch(PDOException $e)
        {
            return $e->getMessage();
        }
    }
}