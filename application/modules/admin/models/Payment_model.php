<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Payment_model extends CI_Model
{
  function listPayment($limit, $from)
  {
    $this->db->select('tbl_payment.*,
                      tbl_user.namalengkap,
                      tbl_simulasi.nama_simulasi')
      ->from('tbl_payment')
      ->join('tbl_user', 'tbl_user.id_user = tbl_payment.id_user', 'left')
      ->join('tbl_simulasi', 'tbl_simulasi.id_simulasi = tbl_payment.id_simulasi', 'left')
      ->where('is_pay', '1')
      ->limit($limit)
      ->offset($from)
      ->order_by('tbl_payment.date_created', 'DESC');
    return $this->db->get()->result();
  }

  function detailPayment($id_payment)
  {
    $this->db->select('tbl_payment.*,
                      tbl_user.namalengkap,
                      tbl_user.email,
                      tbl_simulasi.*')
      ->from('tbl_payment')
      ->join('tbl_user', 'tbl_user.id_user = tbl_payment.id_user', 'left')
      ->join('tbl_simulasi', 'tbl_simulasi.id_simulasi = tbl_payment.id_simulasi', 'left')
      ->where('tbl_payment.id_payment', $id_payment);
    return $this->db->get()->row();
  }

  function cekMember($id_user, $id_simulasi)
  {
    $this->db->select('*')
      ->from('tbl_member')
      ->where('id_user', $id_user)
      ->where('id_simulasi', $id_simulasi);
  }
}
