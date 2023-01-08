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
            $userData['email'],
            $userData['password'],
            $userData['nickname'],
            $userData['id_users_clicks']
        );
        $user->setClicks($this->getClicks($user));
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
