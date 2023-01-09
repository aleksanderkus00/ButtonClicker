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
}
