<div class="jumbotron">
  <div class="container">
    <div class="row">
      <div class="offset-1 col-md-10">
        <div class="card">
          <div class="card-body">

            <div class="container">
              <!-- <canvas id="myChart"></canvas> -->

              <div class="text-center">
                <h4><b>Resume Hasil Pengerjaan</b></h4>

                <table class="table">

                  <tr>
                    <td>Kolom</td>
                    <td>Total</td>
                    <td>Kesalahan</td>
                    <td>Jawaban Benar</td>
                    <td>Xn-X(n-1)</td>
                    <td>Skor Kestabilan</td>
                  </tr>
                  <?php
                  $this->load->model('home/Kecermatan_model', 'KM');
                  $this->load->model('home/Home_model', 'HM');

                  $total_soal = 0;
                  $total_jawaban = 0;
                  $kesalahan = 0;
                  $benar = 0;

                  $xn_prev = 0;
                  $xn_next = 0;
                  $xn_akhir = 0;

                  $kestabilan = 0;

                  $kecepatan = 0;
                  $ketelitian = 0;
                  $ketahanan = 0;
                  $total_soal = $this->KM->total_soal($id_user, $id_simulasi);
                  // echo $total_soal;

                  $total_soal_by_kolom = 0;

                  //ketahanan
                  $x_awal = 0;
                  $x_akhir = 0;

                  $total_jawaban_all = 0;
                  $total_salah_all = 0;
                  $total_benar_all = 0;
                  $total_xn_all = 0;
                  $total_kestabilan_all = 0;

                  $rerata_jawaban = 0;
                  $rerata_kesalahan = 0;
                  $rerata_benar = 0;
                  $rerata_xn = 0;
                  $rerata_kestabilan = 0;


                  $total_kolom = count($taskByMember);


                  $jlh_jawaban = 0;

                  $id_member = null;


                  foreach ($taskByMember as $key => $row) {
                    $id_member = $row->id_member;
                    $taskByKolom = $this->KM->taskByKolom($row->id_member, $row->id_kolom);
                    $taskByKolomOnNull = $this->KM->taskByKolomOnNull($row->id_member, $row->id_kolom);

                    //total jawaban perkolom
                    $total_soal_by_kolom = count($taskByKolom);
                    $total_jawaban_null = count($taskByKolomOnNull);

                    $total_jawaban = $total_soal_by_kolom - $total_jawaban_null;

                    $xn_prev = $xn_next;
                    $xn_next = $total_jawaban;
                    //jawaban benar
                    $benar = $this->KM->cekJawababenar($row->id_member, $row->id_kolom, 'benar');
                    $kesalahan = $this->KM->cekJawababenar($row->id_member, $row->id_kolom, 'salah');

                    // $xn_akhir = $key;

                    if ($key == 0) {
                      $xn_akhir = null;
                      $kestabilan = null;
                    } else {
                      $xn_akhir = $this->KM->xnSelisih($xn_prev, $xn_next);

                      //hitung kestabilan
                      $xn_mutlak = abs($xn_akhir);
                      // echo $xn_mutlak;
                      $kestabilan = 100 - $xn_mutlak * 5;
                    }


                    //hitung kecepatan
                    if ($row->jawaban_kecermatan != null) {
                      $jlh_jawaban = $jlh_jawaban + 1;
                    }
                    $kecepatan = round($jlh_jawaban / $total_soal * 100, 2);

                    //hitung ketelitian
                    $ketelitian = $benar / $total_jawaban * 100;


                    //hitung ketahanan
                    // $ketahanan = 100 - abs()


                    $total_jawaban_all = $total_jawaban_all + $total_jawaban;
                    $total_salah_all = $total_salah_all + $kesalahan;
                    $total_benar_all = $total_benar_all + $benar;
                    $total_xn_all = $total_xn_all + $xn_akhir;
                    $total_kestabilan_all = $total_kestabilan_all + $kestabilan;

                    $rerata_jawaban = $total_jawaban_all / $total_kolom;
                    $rerata_kesalahan = $total_kestabilan_all / $total_kolom;
                    $rerata_benar = $total_benar_all / $total_kolom;
                    $rerata_xn = $total_xn_all / ($total_kolom - 1);
                    $rerata_kestabilan = $total_kestabilan_all / ($total_kolom - 1);


                    if ($row->urutan == 1) {
                      if ($key == 0) {
                        $x_awal = $total_jawaban;
                      }
                    } else if ($row->urutan == $total_kolom) {
                      if ($key == $total_kolom - 1) {
                        $x_akhir = $total_jawaban;
                      }
                    }

                    $ketahanan = 100 - abs($x_awal - $x_akhir);

                  ?>
                    <tr>
                      <td><?= $row->urutan; ?></td>
                      <td><?= $total_jawaban; ?></td>
                      <td><?= $kesalahan; ?></td>
                      <td><?= $benar; ?></td>
                      <td><?= $xn_akhir; ?></td>
                      <td><?= $kestabilan; ?></td>
                    </tr>


                  <?php
                    $this->KM->insertResume($id_member, $id_user, $id_simulasi, $row->id_kolom, $row->urutan, $total_jawaban, $kesalahan, $benar, $xn_akhir, $kestabilan);
                  } ?>
                  <tr>
                    <td>Total</td>
                    <td><?= $total_jawaban_all; ?></td>
                    <td><?= $total_salah_all; ?></td>
                    <td><?= $total_benar_all; ?></td>
                    <td><?= $total_xn_all; ?></td>
                    <td><?= $total_kestabilan_all; ?></td>
                  </tr>
                  <tr>
                    <td>Rata-rata</td>
                    <td><?= round($rerata_jawaban); ?></td>
                    <td><?= round($rerata_kesalahan); ?></td>
                    <td><?= round($rerata_benar); ?></td>
                    <td><?= round($rerata_xn); ?></td>
                    <td><?= round($rerata_kestabilan); ?></td>
                  </tr>
                </table>

                <br>
                <hr>
                <b> Faktor Penilaian</b>
                <hr>
                <br>

                <table class="table">
                  <tr>
                    <td>Kecepatan</td>
                    <td><?= round($kecepatan); ?></td>
                    <td>0.40</td>
                    <td><?= $proporsi_kecepatan = round($kecepatan) * 0.4; ?></td>
                  </tr>

                  <tr>
                    <td>Ketelitian</td>
                    <td><?= round($ketelitian); ?></td>
                    <td>0.20</td>
                    <td><?= $proporsi_ketelitian =  round($ketelitian) * 0.20; ?></td>
                  </tr>

                  <tr>
                    <td>Kestabilan</td>
                    <td><?= round($rerata_kestabilan); ?></td>
                    <td>0.30</td>
                    <td><?= $proporsi_kestabilan = round($rerata_kestabilan) * 0.30; ?></td>
                  </tr>

                  <tr>
                    <td>Ketahanan</td>
                    <td><?= round($ketahanan); ?></td>
                    <td>0.10</td>
                    <td><?= $proporsi_ketahanan = round($ketahanan) * 0.10; ?></td>
                  </tr>

                  <tr>
                    <td><b></b> Total</td>
                    <td><?= round($kecepatan) + round($ketelitian) + round($kestabilan) + round($ketahanan); ?></td>
                    <td>1.00</td>
                    <td><?= $totalSkor = round($proporsi_kecepatan + $proporsi_ketelitian + $proporsi_kestabilan + $proporsi_ketahanan); ?></td>
                  </tr>

                </table>
              </div>
              <?php
              // echo round(2.434534534535, 2);
              // $skor_akhir = $totalSkor * (30 / 100);
              // echo $skor_akhir;
              if ($id_paket != null) {
                $skor_akhir = $totalSkor * (30 / 100);
                $this->HM->editMPaket($id_user, $id_paket, 'kecermatan', $skor_akhir);
              }
              $this->KM->insertSkor($id_member, $id_user, $id_simulasi, $id_paket, $kecepatan, $ketelitian, $rerata_kestabilan, $ketahanan, $totalSkor) ?>
              <a href="<?= base_url('home') ?>" class="btn btn-primary btn-block mt-3">Selesai<i class="fa fa-check"></i></a>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>