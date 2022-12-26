<?php

class User {
    private $email;
    private $password;
    private $nickname;
    private $clicks;
    private $id_clicks;

    public function __construct(
        string $email, 
        string $password, 
        string $nickname,
        int $id_clicks = 0
    ) {
        $this->email = $email;
        $this->password = $password;
        $this->nickname = $nickname;
        $this->id_clicks = $id_clicks;
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

    public function setClicks(int $clicks) {
        $this->clicks = $clicks;
    }

    public function getClicks() {
        return $this->clicks;
    }

    public function setIdClicks(int $id_clicks) {
        $this->id_clicks = $id_clicks;
    }

    public function getIdClicks() {
        return $this->id_clicks;
    }
}