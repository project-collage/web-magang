<?php

namespace App\Controllers;

use App\Models\TahunAjaranModel;

class TahunAjaran extends BaseController
{
    public function __construct()
    {
        $this->ModelTahunAjaran = new TahunAjaranModel();
        helper('form');
    }

    public function index()
    {
        if (session()->get('status') <> "admin") {
            return redirect()->to(base_url('home'));
        }
        $data = array(
            'title' => 'Data Tahun Ajaran',
            'tahun' => $this->ModelTahunAjaran->tampil_tahun_ajaran(),
            'isi' => 'tahun_ajaran/v_tahun_ajaran',
        );

        return view('layout/v_wrapper', $data);
    }

    public function tambah_tahun_ajaran()
    {
        $data = array(
            'tahun' => $this->request->getPost('tahun_ajaran'),
            'status' => $this->request->getPost('status')
        );
        $this->ModelTahunAjaran->tambah_tahun_ajaran($data);
        session()->setFlashData('pesan', 'Data berhasil ditambah');
        return redirect()->to(base_url('tahunajaran'));
    }

    public function edit_tahun_ajaran($id_tahun_ajaran)
    {
        $data = array(
            'idtahun' => $id_tahun_ajaran,
            'tahun' => $this->request->getPost('tahun'),
            'status' => $this->request->getPost('status')
        );
        $this->ModelTahunAjaran->edit_tahun_ajaran($data);
        session()->setFlashData('pesan', 'Data berhasil diupdate');
        return redirect()->to(base_url('tahunajaran'));
    }

    public function hapus_tahun_ajaran($id_tahun_ajaran)
    {
        $data = array(
            'idtahun' => $id_tahun_ajaran,
        );
        $this->ModelTahunAjaran->hapus_tahun_ajaran($data);
        session()->setFlashData('pesan', 'Data berhasil dihapus');
        return redirect()->to(base_url('tahunajaran'));
    }
}
