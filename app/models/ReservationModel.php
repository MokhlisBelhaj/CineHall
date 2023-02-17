<?php
class ReservationModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getAll($user_id)
    {
        $this->db->query('SELECT r.date_reservation,r.place_reservee,f.* FROM reservation r,film f WHERE r.film_id = f.id and r.user_id= :user_id');
        $this->db->bind(":user_id", $user_id);
        $result = $this->db->resultSet();

        if ($this->db->rowCount() == 0) {
            false;
        } else {
            return $result              ;
        }
    }
    public function getPlaceR($datta)
    {
        $this->db->query('SELECT `place_reservee` FROM `reservation` where date_reservation=:date_reservation and film_id=:film_id;');
        $this->db->bind(":date_reservation", $datta['date']);
        $this->db->bind(":film_id", $datta['idFilm']);
        return $this->db->cols();
    }
    public function delete($res_id)
    {
        $this->db->query('SELECT * FROM reservations WHERE hall_id IN (SELECT hall_id FROM films WHERE DATEDIFF(date , CURDATE()) > 1) AND id = :res_id');
        $this->db->bind(":res_id", $res_id);
        $this->db->execute();
        if ($this->db->rowCount() === 0) {
            return false;
        } else {
            $this->db->query('DELETE FROM reservations WHERE id = :res_id');
            $this->db->bind(":res_id", $res_id);
            $this->db->execute();
            return true;
        }
    }
}
