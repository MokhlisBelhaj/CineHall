<?php
class Users extends Controller
{

  private $userModel;
  private $reservationModel;

  public function __construct()
  {
    $this->userModel = $this->model('UsersModel');
    $this->reservationModel = $this->model('ReservationModel');
  }

  // public function all()
  // {
  //   header("Access-Control-Allow-Methods: GET");
  //   header('Access-Control-Allow-Origin: *');
  //   header('Content-Type: application/json');
  //   echo json_encode($this->userModel->getAll());
  // }


  public function register()
  {
    // header("Access-Control-Allow-Methods: POST");
    // header('Access-Control-Allow-Origin: *');
    // header('Content-Type: application/json');
    // Check for POST
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

      $bytes = random_bytes(4);

      $_POST = filter_input_array(INPUT_POST,513);

      $data = [
        'reference' => bin2hex($bytes),
        'name' => $_POST['name'],
        'email' => $_POST['email'],
        'CNI' => $_POST['CNI'],
      ];

      
      if ($this->userModel->register($data)) {
       
        // if ($this->userModel->login($data['reference'])) {
          echo json_encode([
            'Success' => "Registered With Success",
            // 'Ref' => 'Here is your ref to login with : `' . $this->userModel->login($data['reference'])['reference'] . '`'
          ]);
        }
      } else {
        echo json_encode(['Error' => "Registered Failled"]);
      }
    
  }

  public function login()
  {

    header("Access-Control-Allow-Methods: POST");
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

      $_POST = filter_input_array(INPUT_POST, 513);

      $reference = $_POST['reference'];

      if (empty($reference)) {
        echo json_encode(["error" => "please enter your reference"]);
      } else {
        $loggedInUser = $this->userModel->login($reference);

        if ($loggedInUser) {
          echo json_encode($loggedInUser);
        } else {
          echo json_encode(["invalid" => "your reference is invalid"]);
        }
      }
    }
  }

  public function delete($res_id)
  {
    if ($this->reservationModel->getHallId($res_id)) {
      $hall_id = $this->reservationModel->getHallId($res_id);
      if ($this->reservationModel->delete($res_id)) {
        if ($this->reservationModel->decreaseCapacity($hall_id)) {
          echo json_encode(["Success" => "Deleted With Success"]);
        }
      } else {
        echo json_encode(["Error" => "You can only cancel the reservations that are at least one day before the show date"]);
      }
    }
  }

  public function my_reservations()
  {

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

      $_POST = filter_input_array(INPUT_POST, 513);
      $user_id = $_POST['user_id'];

      if ($this->reservationModel->getAll($user_id)) {
        echo json_encode($this->reservationModel->getAll($user_id));
      } else {
        echo json_encode(["None" => "You have no reservations yet"]);
      }
    } else {
      echo json_encode(["Error" => "404 ERROR"]);
    }
  }
}
