
<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('nominal')) {
    function nominal($angka)
    {
        $jd = number_format($angka, 0, ',', '.');
        return $jd;
    }
}

function is_logged_in_user()
{
    $ci = get_instance();
    if (($ci->session->userdata('id_user') == '')) {
        redirect('home/auth');
    }
}

function is_logged_in_admin()
{
    $ci = get_instance();
    if (($ci->session->userdata('id_admin') == '')) {
        redirect('admin/auth');
    }
}

function post($name)
{
    $ci = get_instance();
    $ci->input->post($name);
}

function __is_boolean($table, $where, $id, $field, $value)
{
    $ci = get_instance();
    $data = [
        $field => $value
    ];
    $ci->Crud_model->edit($table, $where, $id, $data);
}


function __is_complete_data_profile($id_user)
{
    $ci = get_instance();
    $profil = $ci->Crud_model->listingOne('tbl_user', 'id_user', $id_user);
    if (($profil->namalengkap == "") || ($profil->email == "") || ($profil->tanggal_lahir == "") || ($profil->gender == "") || ($profil->nohp == "") || ($profil->instagram == "") || ($profil->facebook == "")) {
        $ci->session->set_flashdata('msg_er', 'Data harus  dilengkapi');
        redirect('akun/profil');
    }
}

if (!function_exists('convert_number')) {
    function convert_number($no)
    {
        if (!preg_match('/[+0-9]/', trim($no))) {
            //cek apakah no hp karakter 1-3 ada +62
            if (substr(trim($no), 0, 3) == '+62') {
                $hp = trim($no);
            }
            //cek appakah no hp karakter 1 adlah 0
            elseif (substr(trim($no), 0, 1) == '0') {
                $hp = '+62' . substr(trim($no), 1);
            } else {
                $hp = '00000';
            }
            return $hp;
        }
    }
}


if (!function_exists('time_ago')) {


    function time_ago($time)
    {
        $periods = array("detik", "menit", "jam", "hari", "pekan", "bulan", "tahun", "dekade");
        $lengths = array("60", "60", "24", "7", "4.35", "12", "10");

        $now = date('Y-m-d H:i:s');

        $difference     = $time - $now;
        $tense         = "yang lalu";

        for ($j = 0; $difference >= $lengths[$j] && $j < count($lengths) - 1; $j++) {
            $difference /= $lengths[$j];
        }

        $difference = round($difference);

        // if ($difference != 1) {
        //     $periods[$j] .= "s";
        // }

        return "$difference $periods[$j] yang lalu ";
    }
}

function time_elapsed($date)
{
    $secs = strtotime($date);
    $bit = array(
        ' tahun'        => $secs / 31556926 % 12,
        ' pekan'        => $secs / 604800 % 52,
        ' hari'        => $secs / 86400 % 7,
        ' jam'        => $secs / 3600 % 24,
        ' menit'    => $secs / 60 % 60,
        ' detik'    => $secs % 60
    );

    foreach ($bit as $k => $v) {
        if ($v > 1) $ret[] = $v . $k . '';
        if ($v == 1) $ret[] = $v . $k;
    }
    array_splice($ret, count($ret) - 1, 0, '');
    $ret[] = 'yang lalu.';

    return join(' ', $ret);
}


if (!function_exists('format_indo')) {
    function format_indo($date)
    {
        date_default_timezone_set('Asia/Jakarta');
        // array hari dan bulan
        $Hari = array("Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu");
        $Bulan = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");

        // pemisahan tahun, bulan, hari, dan waktu
        $tahun = substr($date, 0, 4);
        $bulan = substr($date, 5, 2);
        $tgl = substr($date, 8, 2);
        $waktu = substr($date, 11, 5);
        $hari = date("w", strtotime($date));
        $result = $Hari[$hari] . ", " . $tgl . " " . $Bulan[(int)$bulan - 1] . " " . $tahun . " " . $waktu;

        return $result;
    }
}
