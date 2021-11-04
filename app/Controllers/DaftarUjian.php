<?php

namespace App\Controllers;

use App\Models\DaftarUjianModel;
use App\Controllers\mysqli;

class DaftarUjian extends BaseController
{
    public function __construct()
    {
        $this->ModelUjian = new DaftarUjianModel();
        helper('form');
    }

    public function index()
    {
        if (session()->get('status') <> "cpns") {
            return redirect()->to(base_url('home'));
        }
        $data = array(
            'title' => 'Data Ujian',
            'daftar_ujian' => $this->ModelUjian->tampil_ujian(),
            'isi' => 'daftar_ujian/v_daftar_ujian',
        );

        return view('layout/v_wrapper', $data);
    }

    public function prosesujian()
    {

        $mysqli =

            $user =  session()->get('iduser');
        $_SESSION['idujian'] = $_POST['idujian'];

        $n = mysqli_query($mysqli, "select * from nilai where iduser='$user' and idujian='$_SESSION[idujian]'");
        $nilai = mysqli_num_rows($n);
        if ($nilai > 0) {
            return redirect()->to(base_url('nilai'));
        } elseif (!empty($_SESSION['ujian'])) {
            return redirect()->to(base_url('tes'));
        } elseif ($nilai == 0) {
            $token = $_POST['token'];

            $cek = mysqli_query($mysqli, "select * from setujian where idujian='$_SESSION[idujian]' and token='$token'");
            if (mysqli_num_rows($cek) > 0) {
                $data = mysqli_fetch_array($cek);
                $_SESSION['id'] =  $data['idgroup'];


                $soal = mysqli_query(
                    $mysqli,
                    "select s.*, st.*
        from soal as s
        inner join groupsoal as gs
        on gs.idgroup = s.idgroup
        inner join setujian as st 
        on st.idgroup = gs.idgroup
        where s.idgroup = '$_SESSION[id]'
        order by rand()
        limit $data[rangesoal]"
                );
                $jumlah_soal = mysqli_num_rows($soal);
                for ($i = 1; $i <= $jumlah_soal; $i++) {
                    $data = mysqli_fetch_array($soal);
                    mysqli_query($mysqli, "insert into jawaban set
            iduser = '$user', 
            idujian = '$_SESSION[idujian]',
            idsoal = '$data[idsoal]'
            ");
                }
                return redirect()->to(base_url('tes'));
            } else {
                echo "<script>alert('token yang anda masukkan salah !!');window.history.go(-1);</script>";
            }
        } else {
            echo "<script>alert('anda tidak boleh mengakses halaman ini !!');window.history.go(-1);</script>";
        }

        // $data = array(
        //     'isi' => 'daftar_ujian/proses_ujian'
        // );

        // return view('layout/v_wrapper', $data);
    }
}
