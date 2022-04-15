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

  public function listSimulasi($id_mapel)
  {
    $this->db->select('*')
      ->from('tbl_simulasi')
      ->where('id_mapel', $id_mapel)
      ->where('is_active', '1');
    return $this->db->get()->result();
  }

  public function listSimulasiPaket($id_paket)
  {
    $this->db->select('*')
      ->from('tbl_simulasi')
      ->where('id_paket', $id_paket)
      ->where('is_active', '1');
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


  function detailMemberKecermatanPetunjuk($id_user, $id_simulasi)
  {
    $this->db->select('*')
      ->from('tbl_member')
      ->where('id_simulasi', $id_simulasi)
      ->where('id_user', $id_user);
    return $this->db->get()->row();
  }


  function detailMemberKecermatan($id_user, $id_simulasi, $id_kolom)
  {
    $this->db->select('*')
      ->from('tbl_member')
      ->where('id_simulasi', $id_simulasi)
      ->where('id_user', $id_user)
      ->where('id_kolom', $id_kolom);
    return $this->db->get()->row();
  }

  function taskByKolom($id_member, $id_kolom)
  {
    $this->db->select('*')
      ->from('tbl_task')
      ->where('id_member', $id_member)
      ->where('id_kolom', $id_kolom);
    return $this->db->get()->result();
  }

  function taskByKolomOnNull($id_member, $id_kolom)
  {
    $this->db->select('*')
      ->from('tbl_task')
      ->where('id_member', $id_member)
      ->where('id_kolom', $id_kolom)
      ->where('jawaban_kecermatan', null);
    return $this->db->get()->result();
  }

  function cekPaket($id_user, $id_paket)
  {
    $nilai = $this->db->select('*')
      ->from('tbl_m_paket')
      ->where('id_user', $id_user)
      ->where('id_paket', $id_paket)
      ->get()->result();

    if (count($nilai) <= 0) {
      return true;
    } else {
      return false;
    }
  }

  function  insertMPaket($id_user, $id_paket)
  {
    $this->load->helper('string');

    $data = [
      'id_m_paket' => random_string(),
      'id_user'    => $id_user,
      'id_paket'   => $id_paket,
      'kecerdasan' => 0,
      'kepribadian' => 0,
      'kecermatan' => 0,
      'skor_akhir' => 0
    ];
    $this->Crud_model->add('tbl_m_paket', $data);
  }

  function editMPaket($id_user, $id_paket, $field, $skor)
  {

    $nilai = $this->db->select('*')
      ->from('tbl_m_paket')
      ->where('id_user', $id_user)
      ->where('id_paket', $id_paket)
      ->get()->row();

    $skor_akhir = $nilai->kecerdasan + $nilai->kecermatan + $nilai->kepribadian;

    $data = [
      'id_user'       => $id_user,
      'id_paket'      => $id_paket,
      $field          => $skor,
      'skor_akhir'        => $skor_akhir,
    ];
    $this->Crud_model->edit('tbl_m_paket', 'id_m_paket', $nilai->id_m_paket, $data);
  }
}
