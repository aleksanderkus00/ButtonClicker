<?php

require_once 'AppController.php';
require_once __DIR__.'/../models/User.php';

class SecurityController extends AppController {

    public function loginUser() {
        $user = new User('admin@email.com', 'admin', 'admin');
        if (!$this->isPost()) {
            return $this->render('login');
        }
        $email = $_POST["email"];
        $password = $_POST["password"];
        if ($user->getEmail() !== $email) {
            return $this->render('login', ['messages' => ['Wrong email']]);
        }
        if ($user->getPassword() !== $password) {
            return $this->render('login', ['messages' => ['Wrong password']]);
        }
        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location: {$url}/clicker");
    }

    public function registerUser() {
        if (!$this->isPost()) {
            return $this->render('login');
        }
        $email = $_POST["email"];
        $password = $_POST["password"];
        /* email is in db
        if () {
            return $this->render('register', ['messages' => ['Account with this emil already exits']]);
        }
        */
        /*
        password is too weak
        if () {
            return $this->render('register', ['messages' => [Password is too weak']]);
        }
        */
        die("register to be impemented"); // DELETE
        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location: {$url}/login");
    }
}