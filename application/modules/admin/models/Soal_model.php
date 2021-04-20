<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Soal_model extends CI_Model
{
  function listSimulasi()
  {
    $this->db->select('*')
      ->from('tbl_simulasi');
    return $this->db->get()->result();
  }

  function listSimulasiMapel($id_mapel)
  {
    $this->db->select('*')
      ->from('tbl_simulasi')
      ->where('id_mapel', $id_mapel);
    return $this->db->get()->result();
  }


  function detailSimulasi($id_simulasi)
  {
    $this->db->select('*')
      ->from('tbl_simulasi')
      ->where('tbl_simulasi.id_simulasi', $id_simulasi);
    return $this->db->get()->row();
  }

  function listPilihan($where)
  {
    $query = $this->db->select('*')
      ->from('tbl_pilihan')
      ->where('id_soal', $where)
      ->order_by('anotasi', 'ASC')
      ->get();
    return $query->result();
  }

  function listMember($member, $limit = null)
  {
    $this->db->select('tbl_member.*,
                      tbl_user.namalengkap,
                      tbl_simulasi.nama_simulasi')
      ->from('tbl_member')
      ->join('tbl_user', 'tbl_user.id_user = tbl_member.id_user', 'left')
      ->join('tbl_simulasi', 'tbl_simulasi.id_simulasi = tbl_member.id_simulasi', 'left')
      ->where('tbl_member.id_simulasi', $member)
      ->limit($limit)
      ->order_by('tbl_member.date_created', 'DESC');
    return $this->db->get()->result();
  }

  function mySimulasi($id_user)
  {
    $this->db->select('tbl_member.*, 
                      tbl_simulasi.nama_simulasi,
                      tbl_simulasi.type')
      ->from('tbl_member')
      ->join('tbl_simulasi', 'tbl_simulasi.id_simulasi = tbl_member.id_simulasi', 'left')
      ->where('id_user', $id_user);
    return $this->db->get()->result();
  }

  function cekPoin($id_soal, $poin = 0)
  {
    $this->db->select('*')
      ->from('tbl_pilihan')
      ->where('id_soal', $id_soal)
      ->where('poin', $poin);
    return $this->db->get()->row();
  }

  function cekNoSoal($id_simulasi, $no_soal = 0)
  {
    $this->db->select('*')
      ->from('tbl_soal')
      ->where('id_simulasi', $id_simulasi)
      ->where('no_soal', $no_soal);
    return $this->db->get()->row();
  }
}
