<?php

require_once 'Repository.php';
require_once __DIR__.'/..//models/User.php';

class UserRepository extends Repository {
    public function getUser(string $email): ?User {
        $stmt = $this->database->connect()->prepare(
            'SELECT * FROM Users WHERE email = :email'
        );
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();

        $userData = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($userData == false) {
            return null;
        }

        $user = new User(
            $userData['id'],
            $userData['email'],
            $userData['password'],
            $userData['nickname'],
            $userData['id_users_clicks']
        );
        $user->setClicks($this->getClicks($user));
        $this->setUserCookies($user);
        return $user;
    }
    
    public function addUser(User $user) {
        $stmt = $this->database->connect()->prepare(
            'INSERT INTO users_clicks (clicks) VALUES (0)'
        );
        $stmt->execute();
        $stmt = $this->database->connect()->prepare(
            'INSERT INTO users (email, password, nickname, id_users_clicks) VALUES (?, ?, ?, ?)'
        );
        $stmt->execute([
            $user->getEmail(),
            $user->getPassword(),
            $user->getNickname(),
            $this->getUserClicksId($user)
        ]);
    }

    public function getTop100() {
        $stmt = $this->database->connect()->prepare(
            'SELECT u.nickname, uc.clicks  from users u join users_clicks uc on u.id_users_clicks = uc.id order by uc.clicks desc limit 100;'
        );
        $stmt->execute();
        $ranking = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $ranking;
    }

    public function updateClicks($userId, $clicks) {
        $stmt = $this->database->connect()->prepare(
            'SELECT * FROM users WHERE id = :id'
        );
        $stmt->bindParam(':id', $userId, PDO::PARAM_INT);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt = $this->database->connect()->prepare(
            'UPDATE users_clicks set clicks = :clicks where id = :id'
        );
        $stmt->bindParam(':id', $user['id_users_clicks'], PDO::PARAM_INT);
        $stmt->bindParam(':clicks', $clicks, PDO::PARAM_INT);
        $stmt->execute();
    }

    public function updateProp($userId, $propertyName, $newValue) {
        $query = "";
        if ($propertyName == "nickname") {
            $query = 'UPDATE users set nickname = :v where id = :id';
        } else if ($propertyName == "email") {
            $query = 'UPDATE users set email = :v where id = :id';
        } else if ($propertyName == "password") {
            //TODO add hashing
            $query = 'UPDATE users set password = :v where id = :id';
        }
        $stmt = $this->database->connect()->prepare($query);
        $stmt->bindParam(':id', $userId, PDO::PARAM_STR);
        $stmt->bindParam(':v', $newValue, PDO::PARAM_STR);
        $stmt->execute();
    }


    private function setUserCookies(User $user) {
        setCookie('userId', $user->getId());
        setCookie('nickname', $user->getNickname());
        setCookie('clicks', $user->getClicks());
        setCookie('email', $user->getEmail());
    }

    private function getUserClicksId(User $user) {
        $stmt = $this->database->connect()->prepare(
            'SELECT max(id) FROM users_clicks'
        );
        $stmt->execute();
        $clicks = $stmt->fetch(PDO::FETCH_ASSOC);
        return $clicks['max']; 
    }

    private function getClicks(User $user) {
        $stmt = $this->database->connect()->prepare(
            'SELECT * FROM users_clicks WHERE id = :id'
        );
        $stmt->bindParam(':id', $user->getIdClicks(), PDO::PARAM_STR);
        $stmt->execute();
        $clicks = $stmt->fetch(PDO::FETCH_ASSOC);
        return $clicks['clicks']; 
    }
}
