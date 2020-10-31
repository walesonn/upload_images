<?php

namespace App\Controllers;

abstract class Controller{

    public function view(string $view,array $array= null):Controller
    {
        if(!empty($array))
        {
            foreach($array as $key => $value)
            {
                $$key = $value;
            }
        }
        include DIR_VIEWS."/Layout/header.php";
        include DIR_VIEWS."/View/".$view.".php";
        include DIR_VIEWS."/Layout/footer.php";

        return $this;
    }

    public function auth()
    {
        if(!isset($_SESSION['login']) || $_SESSION['login'] === false)
        {
            header("Location: /?p=home");
        }
    }
}