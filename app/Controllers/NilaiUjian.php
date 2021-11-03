<?php

namespace App\Controllers;

use App\Models\NilaiModel;

class NilaiUjian extends BaseController
{

    public function __construct()
    {
        $this->ModelNilai = new NilaiModel();
        helper('form');
    }

    public function index()
    {
        $data = array(
            'title' => 'Nilai Ujian',
            'isi' => 'nilai/v_nilai_ujian',
            'nilai_peserta' => $this->ModelNilai->tampil_nilai_peserta(),
        );

        return view('layout/v_wrapper', $data);
    }
}
