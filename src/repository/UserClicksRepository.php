<?php

require_once 'Repository.php';
require_once __DIR__.'/..//models/User.php';
require_once __DIR__.'/..//models/Clicks.php';

class UserRepository extends Repository {
    public function getClicks(User $user) {
        $stmt = $this->database->connect()->prepare(
            'SELECT * FROM users_clicks WHERE id = :id_clicks'
        );
        $stmt->bindParam(':id_clicks', $user->getIdClicks(), PDO::PARAM_INT);
        $stmt->execute();

        $clicks = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($clicks == false) {
            return null;
        }

        return $clicks['clicks'];
    }

    public function updateClicks(User $user) {
        $stmt = $this->database->connect()->prepare(
            'UPDATE users_clicks SET clicks = :clicks WHERE id = :id'
        );
        $stmt->bindParam(':clicks', $user->getClicks(), PDO::PARAM_INT);
        $stmt->bindParam(':id', $user->getIdClicks(), PDO::PARAM_INT);
        $stmt->execute();
    }
}