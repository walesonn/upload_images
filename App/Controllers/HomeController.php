<?php

namespace App\Controllers;

class HomeController extends Controller{

    public function index()
    {
        return $this->view("home");
    }

    public function painel()
    {
        return $this->view('painel')->auth();
    }

    public function login()
    {
        $_SESSION['login'] = true;
        return $this->view("painel")->auth();
    }

    public function logout()
    {
        session_unset();
        session_destroy();
        return $this->view("home");
    }
}