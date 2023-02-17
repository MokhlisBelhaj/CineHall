<?php
 header('Access-Control-Allow-Origin: *');
 header('Content-Type: application/json');
 header('Access-Control-Allow-Methods: POST');

 if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
   if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
     header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
   if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
     header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
 }
 if ($_SERVER["REQUEST_METHOD"] == "OPTIONS") return true;
class Reservations extends Controller
{
    private $reservations;

    public function __construct()
    {
        $this->reservations = $this->model('ReservationModel');
    }

    public function userReserv($user_id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            // $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = $this->reservations->getAll($user_id);

            if ($data) {
                echo json_encode($data, JSON_PRETTY_PRINT);
            } else {
                echo json_encode([]);
            }
        }
    }
    public function getPlaceRes()
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $datta = [
            'idFilm' => filter_input(INPUT_POST, 'idFilm', FILTER_SANITIZE_NUMBER_INT),
            'date' => filter_input(INPUT_POST, 'date', FILTER_SANITIZE_STRING),
        ];
        $data = $this->reservations->getPlaceR($datta);
        if ($data !== false) {
            echo json_encode($data, JSON_PRETTY_PRINT);
        } else {
            echo json_encode(['error' => 'No data found.']);
        }
    } else {
        http_response_code(405);
        echo json_encode(['error' => 'Invalid request method.']);
    }
}
public function newRes(){
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $datta = [
            'idFilm' => filter_input(INPUT_POST, 'idFilm', FILTER_SANITIZE_NUMBER_INT),
            'date' => filter_input(INPUT_POST, 'date', FILTER_SANITIZE_STRING),
        ];
        $data = $this->reservations->getPlaceR($datta);
        if ($data !== false) {
            echo json_encode($data, JSON_PRETTY_PRINT);
        } else {
            echo json_encode(['error' => 'No data found.']);
        }
    } else {
        http_response_code(405);
        echo json_encode(['error' => 'Invalid request method.']);
    }
}

}