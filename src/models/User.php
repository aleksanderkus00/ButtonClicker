<?php

class User {
    private $email;
    private $password;
    private $nickname;

    public function __construct(
        string $email, 
        string $password, 
        string $nickname
    ) {
       $this->email = $email;
       $this->password = $password;
       $this->nickname = $nickname;
    }

    public function setEmail(string $email) {
        $this->email = $email;
    }

    public function getEmail() {
        return $this->email;
    }
    
    public function setPassword(string $password) {
        $this->password = $password;
    }

    public function getPassword() {
        return $this->password;
    }

    public function setNickname(string $nickname) {
        $this->nickname = $nickname;
    }

    public function getNickname() {
        return $this->nickname;
    }
}