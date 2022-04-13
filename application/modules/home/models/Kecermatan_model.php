<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Kecermatan_model extends CI_Model
{


  function taskByKolom($id_member, $id_kolom)
  {
    $this->db->select('*')
      ->from('tbl_task')
      ->where('id_member', $id_member)
      ->where('id_kolom', $id_kolom);
    return $this->db->get()->result();
  }

  function total_soal($id_user, $id_simulasi)
  {
    $task = $this->db->select('*')
      ->from('tbl_task')
      ->where('id_user', $id_user)
      ->where('id_simulasi', $id_simulasi)
      ->get()->result();

    return count($task);
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

  function cekJawababenar($id_member, $id_kolom, $nilai_apa)
  {
    $task = $this->db->select('tbl_task.*,
                  tbl_kolom.urutan,
                  tbl_soal.jawaban_kecermatan as js_kecermatan')
      ->from('tbl_task')
      ->join('tbl_kolom', 'tbl_kolom.id_kolom = tbl_task.id_kolom', 'left')
      ->join('tbl_soal', 'tbl_soal.id_soal = tbl_task.id_soal', 'left')
      ->where('id_member', $id_member)
      ->where('tbl_task.id_kolom', $id_kolom)
      ->get()->result();



    $benar = 0;
    $salah = 0;

    foreach ($task as $row) {
      if ($row->jawaban_kecermatan == $row->js_kecermatan) {
        $benar = $benar + 1;
      } else {
        $salah = $salah + 1;
      }
    }

    if ($nilai_apa == 'benar') {
      return $benar;
    } else {
      return $salah;
    }
  }

  function xnSelisih($xn_prev, $xn_next)
  {
    return $xn_prev - $xn_next;
  }

  function cekSkor($id_user, $id_simulasi, $id_member)
  {
    $skor = $this->db->select('*')
      ->from('tbl_skor_kecermatan')
      ->where('id_user', $id_user)
      ->where('id_simulasi', $id_simulasi)
      ->where('id_member', $id_member)
      ->get()->result();

    if (count($skor) <= 0) {
      return true;
    } else {
      return false;
    }
  }

  function insertSkor($id_member, $id_user, $id_simulasi, $id_paket, $kecepatan, $ketelitian, $kestabilan, $ketahanan, $total)
  {

    $cek = $this->db->select('*')
      ->from('tbl_skor_kecermatan')
      ->where('id_member', $id_member)
      ->get()->result();

    if (count($cek) <= 0) {

      $this->load->helper('string');

      $data = [
        'id_skor_kecermatan' => random_string(),
        'id_user' => $id_user,
        'id_simulasi' => $id_simulasi,
        'id_paket' => $id_paket,
        'id_member' => $id_member,
        'kecepatan' => $kecepatan,
        'ketelitian' => $ketelitian,
        'kestabilan' => $kestabilan,
        'ketahanan' => $ketahanan,
        'total' => $total
      ];
      // print_r($data);
      // die();

      $this->Crud_model->add('tbl_skor_kecermatan', $data);
    }
  }


  function insertResume($id_member, $id_user, $id_simulasi, $id_kolom, $urutan_kolom, $total_jawab, $kesalahan, $benar, $xn_selisih, $skor_kestabilan)
  {

    $cek = $this->db->select('*')
      ->from('tbl_resume_kecermatan')
      ->where('id_member', $id_member)
      ->get()->result();

    if (count($cek) <= 0) {

      $this->load->helper('string');

      $data = [
        'id_resume_kecermatan' => random_string(),
        'id_member' => $id_member,
        'id_user' => $id_user,
        'id_simulasi' => $id_simulasi,
        'id_kolom' => $id_kolom,
        'urutan_kolom' => $urutan_kolom,
        'total_jawab' => $total_jawab,
        'kesalahan' => $kesalahan,
        'benar' => $benar,
        'xn_selisih' => $xn_selisih,
        'skor_kestabilan' => $skor_kestabilan
      ];
      $this->Crud_model->add('tbl_resume_kecermatan', $data);
    }
  }
}
