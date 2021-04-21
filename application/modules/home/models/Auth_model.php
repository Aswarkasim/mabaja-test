<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth_model extends CI_Model
{
  public function login($email, $password)
  {
    $this->db->select('*')
      ->from('tbl_user')
      ->where(array(
        // 'id_user'      => $id_user,
        'email'      => $email,
        'password'   => sha1($password)
      ));
    $query = $this->db->get();
    return $query->row();
  }
  public function loginUsername($username, $password)
  {
    $this->db->select('*')
      ->from('tbl_user')
      ->where(array(
        'username'      => $username,
        'password'   => sha1($password)
      ));
    $query = $this->db->get();
    return $query->row();
  }
}

/* End of file ModelName.php */
