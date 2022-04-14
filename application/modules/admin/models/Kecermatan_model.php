<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Kecermatan_model extends CI_Model
{


  function taskByPaketSimulasi($id_paket, $id_simulasi)
  {
    $this->db->select('tbl_task.*, tbl_user.namalengkap')
      ->from('tbl_task')
      ->join('tbl_user', 'tbl_user.id_user = tbl_task.id_user')
      ->where('id_paket', $id_paket)
      ->where('id_simulasi', $id_simulasi)
      ->group_by('tbl_task.id_user');
    return $this->db->get()->result();
  }


  function listResumeKecermatan($id_user, $id_simulasi)
  {
    $this->db->select('tbl_resume_kecermatan.*, tbl_user.namalengkap')
      ->from('tbl_resume_kecermatan')
      ->join('tbl_user', 'tbl_user.id_user = tbl_resume_kecermatan.id_user')
      ->where('tbl_resume_kecermatan.id_user', $id_user)
      ->where('tbl_resume_kecermatan.id_simulasi', $id_simulasi);
    return $this->db->get()->result();
  }

  function listSkorKecermatanAll($id_user, $id_simulasi)
  {
    $this->db->select('*')
      ->from('tbl_skor_kecermatan')
      ->where('id_user', $id_user)
      ->where('id_simulasi', $id_simulasi);
    return $this->db->get()->result();
  }

  function listSkorKecermatan($id_user, $id_simulasi)
  {
    $this->db->select('*')
      ->from('tbl_skor_kecermatan')
      ->where('id_user', $id_user)
      ->where('id_simulasi', $id_simulasi);
    return $this->db->get()->row();
  }




  function listMember($id_simulasi)
  {
    $this->db->select('tbl_member.*,
                      tbl_user.namalengkap,')
      ->from('tbl_member')
      ->join('tbl_user', 'tbl_user.id_user = tbl_member.id_user', 'left')
      ->where('tbl_member.id_simulasi', $id_simulasi)
      ->group_by('id_user')
      ->order_by('tbl_member.date_created', 'DESC');
    return $this->db->get()->result();
  }

  
}
