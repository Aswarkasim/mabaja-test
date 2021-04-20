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

  function listKupon()
  {
    $this->db->select('tbl_kupon.*,
                      tbl_admin.nama_admin')
      ->from('tbl_kupon')
      ->join('tbl_admin', 'tbl_admin.id_admin = tbl_kupon.id_admin', 'left')
      ->order_by('tbl_kupon.date_created', 'DESC');
    return $this->db->get()->result();
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
