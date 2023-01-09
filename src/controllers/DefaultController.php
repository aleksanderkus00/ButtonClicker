<?php

require_once 'AppController.php';

class DefaultController extends AppController {

    public function clicker() {
        if (isset($_COOKIE["userId"])) {
            $this->render('main');
            return;
        }
        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location: {$url}/login");
    }

    public function login() {
        $this->render('login');
    }

    public function register() {
        $this->render('register');
    }
}
