<?php

require  __DIR__."/vendor/autoload.php";
require __DIR__."/Conf/paths.php";
require __DIR__."/Conf/database.php";

session_start();
use App\Controllers\HomeController;

$page = isset($_GET['p'])? $_GET['p'] : "home";
$controller = new HomeController();

switch($page)
{
    case "home":
        $controller->index();
    break;
    case "upload":
        $controller->upload();
    break;
    case "imagem":
        $controller->verImagem();
    break;
    case "delete":
        $controller->delete();
    break;
    default:
        echo "<h1 style='color: grey; text-align: center; margin-top: 110px'>ERROR HTTP 404 PAGE NOT FOUND</h1>";
    break;
}

