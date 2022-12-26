<?php

require_once 'AppController.php';
require_once __DIR__.'/../models/User.php';
require_once __DIR__.'/../repository/UserRepository.php';

class SecurityController extends AppController {
    private $userRepository;

    public function __construct() {
        parent::__construct();
        $this->userRepository = new UserRepository(); 
    }

    public function loginUser() {
        if (!$this->isPost()) {
            return $this->render('login');
        }
        $email = $_POST["email"];
        $password = $_POST["password"];
        $user = $this->userRepository->getUser($email);
        
        if (!$user) {
            return $this->render('login', ['messages' => ['User not exist']]);
        }
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
            return $this->render('register');
        }
        $email = $_POST["email"];
        $password = $_POST["password"];
        if ($email === "" || $password === "") {
            return $this->render('register');
        }

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
        $nickname = strstr($email, '@', true);
        $user = new User($email, $password, $nickname);
        $this->userRepository->addUser($user);
        return $this->render('login', ['messages' => ['You\'ve been successfully registered!']]);
    }
}