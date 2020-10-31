<?php

require  __DIR__."/vendor/autoload.php";
require __DIR__."/Conf/paths.php";
require __DIR__."/Conf/database.php";

session_start();

use App\Controllers\HomeController;
use App\Controllers\Auth;
use App\Models\User;



$user['email'] = isset($_POST['email'])? $_POST['email'] : null;
$user['senha'] = isset($_POST['senha'])? $_POST['senha'] : null;

if( (!empty($user['email']) && !empty($user['senha'])) )
{
    Auth::login( new User($user['email'], md5($user['senha']) ));
}

$page = isset($_GET['p'])? $_GET['p'] : "home";
$controller = new HomeController();

switch($page)
{
    case "home":
        $controller->index();
    break;
    case "painel":
        $controller->painel();
    break;
    case "auth":
        $controller->login();
    break;
    case "logout":
        $controller->logout();
    break;
    default:
        echo "<h1 style='color: red; text-align: center;'>ERROR HTTP 404 PAGE NOT FOUND</h1>";
    break;
}

