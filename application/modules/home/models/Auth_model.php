<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth_model extends CI_Model
{
  public function login($email, $password)
  {
    $this->db->select('tbl_user.*, tbl_kelas.is_active as kelas_active')
      ->from('tbl_user')
      ->join('tbl_kelas', 'tbl_user.id_kelas = tbl_kelas.id_kelas', 'left')
      ->where('tbl_user.email', $email)
      ->where('tbl_user.password', sha1($password));
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
