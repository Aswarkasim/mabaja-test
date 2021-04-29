<?php


defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends CI_Model
{

  function listRiwayat($id_user)
  {
    $this->db->select('tbl_member.*, 
                      tbl_simulasi.nama_simulasi,
                      tbl_mapel.nama_mapel')
      ->from('tbl_member')
      ->join('tbl_simulasi', 'tbl_simulasi.id_simulasi = tbl_member.id_simulasi', 'left')
      ->join('tbl_mapel', 'tbl_simulasi.id_mapel = tbl_mapel.id_mapel', 'left')
      ->where('id_user', $id_user);
    return $this->db->get()->result();
  }

  function myPaketDetail($id_user, $id_simulasi)
  {
    $this->db->select('*')->from('tbl_member')
      ->where('id_user', $id_user)
      ->where('id_simulasi', $id_simulasi);
    return $this->db->get()->row();
  }




  function myPayment($id_user)
  {
    $this->db->select('tbl_payment.*, 
                      tbl_simulasi.nama_simulasi,
                      tbl_simulasi.type')
      ->from('tbl_payment')
      ->join('tbl_simulasi', 'tbl_simulasi.id_simulasi = tbl_payment.id_simulasi', 'left')
      ->where('id_user', $id_user)
      ->order_by('date_updated', 'DESC');
    return $this->db->get()->result();
  }
}

/* End of file ModelName.php */
