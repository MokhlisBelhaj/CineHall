<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization,X-Requested-With');
class film  extends Controller{
    private $film;
    public function __construct(){
        $this->film = $this->model('filmModel');
    }

    public function getfilms() {
        if($this->film->getall()) {
            echo json_encode($this->film->getall());
        } else {
            echo json_encode(['error' => 'error']);
        }
    }
        
       
}
