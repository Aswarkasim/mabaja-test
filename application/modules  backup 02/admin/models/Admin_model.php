<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Admin_model extends CI_Model
{
  public function login($email, $password)
  {
    $this->db->select('*')
      ->from('tbl_admin')
      ->where(array(
        'email'      => $email,
        'password'   => sha1($password)
      ));
    $query = $this->db->get();
    return $query->row();
  }
  public function loginUsername($username, $password)
  {
    $this->db->select('*')
      ->from('tbl_admin')
      ->where(array(
        'username'      => $username,
        'password'   => sha1($password)
      ));
    $query = $this->db->get();
    return $query->row();
  }


  function listUser($id_kelas = null)
  {
    return $this->db->select('*')
      ->from('tbl_user')
      ->where('id_kelas', $id_kelas)
      ->order_by('date_created', 'DESC')
      ->get()
      ->result();
  }

  function listUserDasboard()
  {
    return $this->db->select('*')
      ->from('tbl_user')
      ->where('is_read', '0')
      ->order_by('date_created', 'DESC')
      ->limit(10)
      ->get()
      ->result();
  }

  function listKelas()
  {
    $this->db->select('tbl_kelas.*,
                      tbl_mapel.nama_mapel')
      ->from('tbl_kelas')
      ->join('tbl_mapel', 'tbl_mapel.id_mapel = tbl_kelas.id_mapel', 'left')
      ->order_by('tbl_kelas.date_created', 'DESC');
    return $this->db->get()->result();
  }

  function kelasAktif($value = null)
  {
    return $this->db->select('*')
      ->from('tbl_kelas')
      ->where('is_active', $value)
      ->get()
      ->result();
  }

  public function graph()
  {
    $data = $this->db->query("SELECT * from datapenduduk");
    return $data->result();
  }

  function month()
  {
    // $query = $this->db->query("SELECT * FROM tbl_payment WHERE MONTH(date_created) = MONTH('2020-11-21 08:12:58') AND YEAR(date_created) = YEAR(CURRENT_DATE())");
    $query = $this->db->query("SELECT * FROM tbl_payment WHERE MONTH(date_created) = '12' AND YEAR(date_created) = '2020' ");
    return $query->result();
  }

  function year($year)
  {
    // $query = $this->db->query("SELECT * FROM tbl_payment WHERE MONTH(date_created) = MONTH('2020-11-21 08:12:58') AND YEAR(date_created) = YEAR(CURRENT_DATE())");
    $query = $this->db->query("SELECT * FROM tbl_payment WHERE YEAR(date_created) = '$year'");
    return $query->result();
  }

  function sumPayment($bulan, $tahun)
  {
    $query = $this->db->query("SELECT * FROM tbl_payment WHERE is_valid = '1' AND MONTH(date_created) = '$bulan' AND YEAR(date_created) = '$tahun' ");
    return $query->result();
  }

  function penjualan($bulan)
  {
    $query = $this->db->query("SELECT sum(jumlah) as jumlah from tb_penjualan where MONTH(tgl_penjualan)='$bulan'");
    return $query->row();
  }

  function sumPenghasilanBulanan($bulan, $tahun)
  {
    $query = $this->db->query("SELECT SUM(jumlah_bayar) as totalPenghasilan FROM tbl_payment WHERE is_valid = '1' AND MONTH(date_created) = $bulan AND YEAR(date_created) = '$tahun'");
    return $query->row();
  }

  function sumPenghasilanTahunan($tahun)
  {
    $query = $this->db->query("SELECT SUM(jumlah_bayar) as totalPenghasilan FROM tbl_payment WHERE is_valid = '1' AND YEAR(date_created) = '$tahun'");
    return $query->row();
  }

  function sumPenjualanTahunan($tahun)
  {
    $query = $this->db->query("SELECT * FROM tbl_payment WHERE is_valid = '1' AND  YEAR(date_created) = '$tahun' ");
    return $query->result();
  }
}
