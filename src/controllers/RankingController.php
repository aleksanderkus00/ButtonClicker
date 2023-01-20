<?php

require_once 'AppController.php';
require_once __DIR__.'/../repository/UserRepository.php';

class RankingController extends AppController {
    private $userRepository;

    public function __construct() {
        parent::__construct();
        $this->userRepository = new UserRepository(); 
    }

    public function getTop10() {
        $top10 = $this->userRepository->getTop10();
        echo json_encode($top10);
        return json_encode($top10);
    }
}
