

<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Data_model extends CI_Model
{

  function listPesertaPaket($id_paket)
  {
    $this->db->select('tbl_m_paket.*, tbl_user.namalengkap')
      ->from('tbl_m_paket')
      ->join('tbl_user', 'tbl_user.id_user = tbl_m_paket.id_user', 'left')
      ->where('tbl_m_paket.id_paket', $id_paket);
    return $this->db->get()->result();
  }

  function listMemberByPaket($id_user, $id_paket)
  {
    $this->db->select('*')
      ->from('tbl_member')
      ->where('id_user', $id_user)
      ->where('id_paket', $id_paket);
    return $this->db->get()->result();
  }

  function listSkorMPaketByUser($id_user, $id_paket)
  {
    $this->db->select('*')
      ->from('tbl_m_paket')
      ->where('id_user', $id_user)
      ->where('id_paket', $id_paket);
    return $this->db->get()->row();
  }
}

/* End of file ModelName.php */
