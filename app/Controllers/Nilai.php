<?php

namespace App\Controllers;

use App\Models\NilaiModel;

class Nilai extends BaseController
{
    public function __construct()
    {
        $this->ModelNilai = new NilaiModel();
        helper('form');
    }

    public function index() //admin
    {
        $data = array(
            'title' => 'Data Nilai',
            'isi' => 'nilai/v_nilai',
            'nilai_admin' => $this->ModelNilai->tampil_data_nilai_admin(),

        );

        return view('layout/v_wrapper', $data);
    }

    public function nilai_guru() //nilai utama guru
    {
        $data = array(
            'title' => 'Nilai Ujian',
            'isi' => 'nilai/v_nilai_guru',
            'nilai_guru' => $this->ModelNilai->tampil_data_nilai_guru(),
        );

        return view('layout/v_wrapper', $data);
    }

    public function tampil_nilai_siswa() //siswa
    {
        $data = array(
            'title' => 'Data Nilai Siswa',
            'isi' => 'nilai/v_nilai_siswa',
            'nilai_siswa' => $this->ModelNilai->tampil_data_nilai_siswa()
        );

        return view('layout/v_wrapper', $data);
    }

    public function hapus_nilai($id_nilai)
    {
        $data = array(
            'idnilai' => $id_nilai,
        );
        $this->ModelNilai->hapus_nilai($data);
        session()->setFlashData('pesan', 'Data berhasil dihapus');
        return redirect()->to(base_url('home'));
    }

    public function proses_nilai()
    {
        if (!isset($_SESSION)) {
            session_start();
        }
        $mysqli = \Config\Database::connect('default');


        $iduser = $_SESSION['iduser'];
        $idgroup = $_SESSION['id'];
        $idujian = $_SESSION['idujian'];



        $tampil = $mysqli->query(
            "select j.*, s.*
from jawaban as j
join soal as s
on j.idsoal = s.idsoal
where 
j.iduser = '$iduser' and
j.idujian = '$idujian' and 
j.jawaban = s.pilihanbenar "
        );
        $jumlah_benar = $tampil->getNumRows();

        $s = $mysqli->query(
            "select j.*, s.soal
from jawaban as j
inner join soal as s
on j.idsoal = s.idsoal
where j.idujian = '$idujian' and j.iduser = '$iduser'"
        );
        $soal = $s->getNumRows();

        $nilai = $jumlah_benar * 100 / $soal;

        $insert = $mysqli->query("insert into nilai set 
iduser = '$iduser', 
idujian = '$idujian', 
nilai = '$nilai',
tgl = now() ");

        unset($_SESSION['ujian']);
        unset($_SESSION['mulai']);
        return redirect()->to(base_url('nilai/hasil_nilai'));
    }

    public function hasil_nilai()
    {

        $data = array(
            'title' => 'Hasil Nilai Siswa',
            'isi' => 'nilai/v_hasil_nilai',

        );
        return view('layout/v_wrapper', $data);
    }
}
