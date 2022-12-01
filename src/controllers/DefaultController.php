<?php

require_once 'AppController.php';

class DefaultController extends AppController {

    public function clicker() {
        $this->render('main');
    }

    public function login() {
        $this->render('login');
    }

    public function register() {
        $this->render('register');
    }
}
