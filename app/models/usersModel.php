<?php
class UsersModel
{
  private $db;

  public function __construct()
  {
    $this->db = new Database;
  }

  public function getAll()
  {
    $this->db->query('SELECT * FROM user');
    return $this->db->resultSet();
  }
  // Regsiter user
  public function register($data)
  {
    $this->db->query('INSERT INTO `user` (reference, name, email, CNI) VALUES(:reference , :name , :email ,:CNI)');
    // Bind values
    $this->db->bind(':reference', $data['reference']);
    $this->db->bind(':name', $data['name']);
    $this->db->bind(':email', $data['email']);
    $this->db->bind(':CNI', $data['CNI']);

    // Execute
    if ($this->db->execute()) {
      return true;
    } else {
      return false;
    }
  }

  // Login User
  public function login($reference)
  {
    $this->db->query('SELECT * FROM `user`WHERE reference=:unique_key');
    $this->db->bind(':unique_key', $reference);

    $row = $this->db->single();

    if ($row) {
      return $row;
    } else {
      return false;
    }
  }
}
