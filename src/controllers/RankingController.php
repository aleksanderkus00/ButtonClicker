<?php

require_once 'AppController.php';
require_once __DIR__.'/../repository/UserRepository.php';

class RankingController extends AppController {
    private $userRepository;

    public function __construct() {
        parent::__construct();
        $this->userRepository = new UserRepository(); 
    }

    public function getTop100() {
        $top100 = $this->userRepository->getTop100();
        echo json_encode($top100);
        return json_encode($top100);
    }

    public function updateClicks() {
        $contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';

        if ($contentType === "application/json") {
            $content = trim(file_get_contents("php://input"));
            $decoded = json_decode($content, true);
            $this->userRepository->updateClicks($decoded['userId'], $decoded['clicks']);
        }
    }
    public function updateProp() {
        $contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';

        if ($contentType === "application/json") {
            $content = trim(file_get_contents("php://input"));
            $decoded = json_decode($content, true);
            $this->userRepository->updateProp($decoded['userId'], $decoded['propertyName'], $decoded['newValue']);
        }
    }
}
