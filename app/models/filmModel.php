<?php
class filmModel extends Database{
    private $db;
    public function __construct(){
        $this->db = new Database;
      }
    public function getall(){
        $this->db->query("SELECT * FROM film");
        if($this->db->resultSet()) {
            return $this->db->resultSet();
        } else {
            return  false;
        }
    }
}

