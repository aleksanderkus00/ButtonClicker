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
        if(array_key_exists('registerButton', $_POST)) {
            return $this->render('register');
        }
        $email = $_POST["email"];
        $password = md5($_POST["password"]);
        if ($email === "" || $password === "") {
            return $this->render('login');
        }
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
        if(array_key_exists('loginButton', $_POST)) {
            return $this->render('login');
        }
        $email = $_POST["email"];
        $password = md5($_POST["password"]);
        if ($email === "" || $password === "") {
            return $this->render('register');
        }
        $nickname = strstr($email, '@', true);
        $user = new User(0, $email, $password, $nickname);
        $this->userRepository->addUser($user);
        return $this->render('login', ['messages' => ['You\'ve been successfully registered!']]);
    }

}