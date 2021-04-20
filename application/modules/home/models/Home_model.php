<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Home_model extends CI_Model
{

  public function listBanner($limit)
  {
    $this->db->select('*')
      ->from('tbl_banner')
      ->order_by('urutan', 'ASC');
    return $this->db->get()->result();
  }

  public function listPaket($limit)
  {
    $this->db->select('*')
      ->from('tbl_simulasi')
      ->where('is_active', '1')
      ->limit($limit);
    return $this->db->get()->result();
  }


  public function detailPaket($id_simulasi)
  {
    $this->db->select('*')
      ->from('tbl_simulasi')
      ->where('id_simulasi', $id_simulasi);
    return $this->db->get()->row();
  }

  function detailInvoice($id_payment)
  {
    $this->db->select('tbl_payment.*, 
                      tbl_simulasi.*')
      ->from('tbl_payment')
      ->join('tbl_simulasi', 'tbl_simulasi.id_simulasi = tbl_payment.id_simulasi', 'left')
      ->where('id_payment', $id_payment);
    return $this->db->get()->row();
  }

  function cekInvoice($id_user, $id_simulasi)
  {
    $this->db->select('*')
      ->from('tbl_payment')
      ->where('id_user', $id_user)
      ->where('id_simulasi', $id_simulasi)
      ->where('is_active', '1');
    return $this->db->get()->row();
  }

  function cekMember($id_user, $id_simulasi)
  {
    $this->db->select('*')
      ->from('tbl_member')
      ->where('id_user', $id_user)
      ->where('id_simulasi', $id_simulasi);
    return $this->db->get()->row();
  }





  function listPilihan($id_soal)
  {
    $this->db->select('*')
      ->from('tbl_pilihan')
      ->where('id_soal', $id_soal)
      ->order_by('anotasi', 'ASC');
    return $this->db->get()->result();
  }

  function listKlasifikasi($id_simulasi)
  {
    $this->db->select('*')
      ->from('tbl_soal')
      ->where('id_simulasi', $id_simulasi)
      ->where('is_done', '1');
    return $this->db->get()->result();
  }

  function detailMember($id_user, $id_simulasi)
  {
    $this->db->select('*')
      ->from('tbl_member')
      ->where('id_simulasi', $id_simulasi)
      ->where('id_user', $id_user);
    return $this->db->get()->row();
  }



  function cekKupon($kupon)
  {
    $this->db->select('*')
      ->from('tbl_token')
      ->where('token', $kupon);
    return $this->db->get()->row();
  }

  function rangking($id_simulasi)
  {
    $this->db->select('tbl_rangking.*, 
                      tbl_user.namalengkap,
                      tbl_user.foto,
                      tbl_simulasi.nama_simulasi')
      ->from('tbl_rangking')
      ->join('tbl_user', 'tbl_user.id_user = tbl_rangking.id_user', 'left')
      ->join('tbl_simulasi', 'tbl_simulasi.id_simulasi = tbl_rangking.id_simulasi', 'left')
      ->where('tbl_rangking.id_simulasi', $id_simulasi)
      ->order_by('tbl_rangking.nilai', 'DESC')
      ->order_by('tbl_rangking.date_created', 'ASC')
      ->limit('10');
    return $this->db->get()->result();
  }
}
