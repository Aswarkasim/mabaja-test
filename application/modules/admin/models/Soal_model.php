<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Soal_model extends CI_Model
{
  function listKecermatan($id_kolom)
  {
    $this->db->select('*')
      ->from('tbl_soal')
      ->where('id_kolom', $id_kolom)
      ->order_by('no_soal', 'ASC');
    return $this->db->get()->result();
  }

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

  function listJawabanKecermatan($id_soal)
  {
    $query = $this->db->select('*')
      ->from('tbl_jawaban_kecermatan')
      ->where('id_soal', $id_soal)
      ->order_by('no_soal_kecermatan', 'ASC')
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

  function detailHasilMemberKecermatan($id_user, $id_simulasi)
  {
    $this->db->select('*')
      ->from('tbl_member')
      ->where('id_user', $id_user)
      ->where('id_simulasi', $id_simulasi)
      ->order_by('urutan_kecermatan', 'ASC');
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

  function cekNoSoalKolom($id_kolom, $no_soal = 0)
  {
    $this->db->select('*')
      ->from('tbl_soal')
      ->where('id_kolom', $id_kolom)
      ->where('no_soal', $no_soal);
    return $this->db->get()->row();
  }

  function cekNoSesi($id_simulasi, $no_sesi = 0)
  {
    $this->db->select('*')
      ->from('tbl_soal')
      ->where('id_simulasi', $id_simulasi)
      ->where('no_sesi', $no_sesi);
    return $this->db->get()->row();
  }

  function cekNoKolom($id_simulasi, $urutan = 0)
  {
    $this->db->select('*')
      ->from('tbl_kolom')
      ->where('id_simulasi', $id_simulasi)
      ->where('urutan', $urutan);
    return $this->db->get()->row();
  }

  function getIdJawabanKecermatan($id_soal, $no_soal_kecermatan = 0)
  {
    $this->db->select('*')
      ->from('tbl_jawaban_kecermatan')
      ->where('id_soal', $id_soal)
      ->where('no_soal_kecermatan', $no_soal_kecermatan);
    return $this->db->get()->row();
  }

  function pilihanTask($id_member)
  {
    $this->db->select('tbl_task.*, 
                    tbl_pilihan.anotasi,
                    tbl_soal.id_pilihan as jawaban_benar')
      ->from('tbl_task')
      ->join('tbl_pilihan', 'tbl_pilihan.id_pilihan = tbl_task.id_pilihan', 'left')
      ->join('tbl_soal', 'tbl_soal.id_soal = tbl_task.id_soal', 'left')
      ->where('tbl_task.id_member', $id_member)
      ->order_by('tbl_task.no_soal', 'ASC');
    return $this->db->get()->result();
  }

  function countSoalDone($id_simulasi)
  {
    $this->db->select('*')
      ->from('tbl_soal')
      ->where('id_simulasi', $id_simulasi)
      ->where('is_done', '1');
    return $this->db->get()->result();
  }

  function countKolomDone($id_simulasi)
  {
    $this->db->select('*')
      ->from('tbl_kolom')
      ->where('id_simulasi', $id_simulasi)
      ->where('is_active', '1');
    return $this->db->get()->result();
  }

  function getSimulasiUser($id_user, $id_simulasi)
  {
    $this->db->select('*')
      ->from('tbl_member')
      ->where('id_user', $id_user)
      ->where('id_simulasi', $id_simulasi)
      ->order_by('urutan_kecermatan', 'ASC');
    return $this->db->get()->result();
  }
}
