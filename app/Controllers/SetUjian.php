<?php

namespace App\Controllers;

use App\Models\SetUjianModel;

class SetUjian extends BaseController
{
    public function __construct()
    {
        $this->ModelUjian = new SetUjianModel();
        helper('form');
    }

    public function index()
    {
        if (session()->get('status') <> "guru") {
            return redirect()->to(base_url('home'));
        }
        $data = array(
            'title' => 'Data Ujian',
            'ujian' => $this->ModelUjian->tampil_ujian(),
            'dropdown_group' => $this->ModelUjian->dropdown_group(),
            'isi' => 'setujian/v_setujian',
        );

        return view('layout/v_wrapper', $data);
    }

    public function tambah_ujian()
    {
        $data = array(
            'user' => session()->get('iduser'),
            'idgroup' => $this->request->getPost('groupsoal'),
            'rangesoal' => $this->request->getPost('range_soal'),
            'waktu' => $this->request->getPost('waktu'),
            'token' => $this->request->getPost('token'),
            'status' => $this->request->getPost('status'),
            'jnssoal' => $this->request->getPost('jenis_soal'),
        );
        $this->ModelUjian->tambah_ujian($data);
        session()->setFlashData('pesan', 'Data berhasil ditambah');
        return redirect()->to(base_url('setujian'));
    }

    public function edit_ujian($id_ujian)
    {
        $data = array(
            'idujian' => $id_ujian,
            'idgroup' => $this->request->getPost('groupsoal'),
            'rangesoal' => $this->request->getPost('jml_soal'),
            'waktu' => $this->request->getPost('waktu'),
            'token' => $this->request->getPost('token'),
            'status' => $this->request->getPost('status'),
            'jnssoal' => $this->request->getPost('jnssoal'),
        );
        $this->ModelUjian->edit_ujian($data);
        session()->setFlashData('pesan', 'Data berhasil diupdate');
        return redirect()->to(base_url('setujian'));
    }

    public function hapus_ujian($id_ujian)
    {
        $data = array(
            'idujian' => $id_ujian,
        );
        $this->ModelUjian->hapus_ujian($data);
        session()->setFlashData('pesan', 'Data berhasil dihapus');
        return redirect()->to(base_url('setujian'));
    }
}
