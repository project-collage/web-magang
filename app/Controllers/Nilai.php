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

    public function index()
    {
        $data = array(
            'title' => 'Data Nilai',
            'isi' => 'nilai/v_nilai',
            'nilai_admin' => $this->ModelNilai->tampil_data_nilai_admin(),
            'nilai_guru' => $this->ModelNilai->tampil_data_nilai_guru(),
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
        return redirect()->to(base_url('nilai'));
    }
}
