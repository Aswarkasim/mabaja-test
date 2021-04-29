<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Soal_model extends CI_Model
{
  function kunciJawabanCpns($id_member, $klasifikasi)
  {
    $this->db->select('tbl_task.*,
                      tbl_pilihan.poin,
                      tbl_simulasi.type,
                      tbl_soal.klasifikasi, 
                      tbl_soal.id_pilihan as kunci_jawaban')
      ->from('tbl_task')
      ->join('tbl_soal', 'tbl_soal.id_soal = tbl_task.id_soal', 'left')
      ->join('tbl_simulasi', 'tbl_simulasi.id_simulasi = tbl_task.id_simulasi', 'left')
      ->join('tbl_pilihan', 'tbl_pilihan.id_pilihan = tbl_task.id_pilihan', 'left')
      ->where('tbl_task.id_member', $id_member)
      ->where('tbl_soal.klasifikasi', $klasifikasi);
    return $this->db->get()->result();
  }

  function kunciJawabanUtbk($id_member, $fokus_tes)
  {
    $this->db->select('tbl_task.*,
                      tbl_simulasi.type,
                      tbl_soal.fokus_tes, 
                      tbl_soal.klasifikasi, 
                      tbl_soal.poin, 
                      tbl_soal.id_pilihan as kunci_jawaban')
      ->from('tbl_task')
      ->join('tbl_soal', 'tbl_soal.id_soal = tbl_task.id_soal', 'left')
      ->join('tbl_simulasi', 'tbl_simulasi.id_simulasi = tbl_task.id_simulasi', 'left')
      ->where('tbl_task.id_member', $id_member)
      ->where('tbl_soal.fokus_tes', $fokus_tes);
    return $this->db->get()->result();
  }

  function getNilaiPerolehan($id_member, $fokus_tes)
  {
    $jawaban = $this->kunciJawabanUtbk($id_member, $fokus_tes);
    $perolehan = 0;
    foreach ($jawaban as $row) {
      if ($row->id_pilihan == $row->kunci_jawaban) {
        $perolehan = $perolehan + $row->poin;
      }
    }

    return $perolehan;
  }

  function getSoalPaket($id_simulasi, $fokus_tes)
  {
    $this->db->select('*')
      ->from('tbl_soal')
      ->where('id_simulasi', $id_simulasi)
      ->where('fokus_tes', $fokus_tes);
    return $this->db->get()->result();
  }

  function nilaiMax($id_simulasi, $fokus_tes)
  {
    $soal = $this->getSoalPaket($id_simulasi, $fokus_tes);
    $nilaiMax = 0;
    foreach ($soal as $row) {
      $nilaiMax = $nilaiMax + $row->poin;
    }
    return $nilaiMax;
  }

  function nilaiAkhir($nilaiPerolehan, $nilaiMax)
  {
    $x = 0;
    if (($nilaiPerolehan != 0) && $nilaiMax != 0) {
      $x = $nilaiPerolehan * 500 / $nilaiMax;
    }
    $x = $x + 250;
    return $x;
  }

  function butirSoal($id_user, $id_simulasi, $butir)
  {
    $this->db->select('tbl_task.*, 
                      tbl_soal.butir_soal,
                      tbl_soal.pembahasan')
      ->from('tbl_task')
      ->join('tbl_soal', 'tbl_soal.id_soal = tbl_task.id_soal', 'left')
      ->where('tbl_task.id_user', $id_user)
      ->where('tbl_task.id_simulasi', $id_simulasi)
      ->where('tbl_task.no_soal', $butir);
    return $this->db->get()->row();
  }


  function listSoal($id_member)
  {
    $this->db->select('*')
      ->from('tbl_task')
      ->where('id_member', $id_member)
      ->order_by('no_soal', 'ASC');
    return $this->db->get()->result();
  }

  function soalTerjawab($id_member, $status)
  {
    $this->db->select('*')
      ->from('tbl_task')
      ->where('id_member', $id_member)
      ->where('is_done', $status);
    return $this->db->get()->result();
  }
}

/* End of file ModelName.php */
