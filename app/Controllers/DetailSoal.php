<?php

namespace App\Controllers;

use App\Models\DetailModel;
use App\Models\GroupSoalModel;

class DetailSoal extends BaseController
{
    public function __construct()
    {
        $this->DetailModel = new DetailModel();
        $this->ModelGroupSoal = new GroupSoalModel();
        helper('form');
    }

    public function detail_soal($id_group)
    {
        $data = array(
            'title' => 'Detail Soal',
            'soal' => $this->DetailModel->detail_soal($id_group),
            'tambah' => $this->DetailModel->tambah_soal($id_group),
            'isi' => 'detail/v_detail_soal'
        );
        return view('layout/v_wrapper', $data);
    }

    public function tambahsoal($id_group)
    {
        $data = array(
            'tambah_soal' => $this->DetailModel->tambah_soal($id_group),
            'title' => 'Tambah Soal',
            'isi' => 'detail/v_tambah_soal'
        );
        return view('layout/v_wrapper', $data);
    }

    public function prosestambahsoal()
    {
        $data = array(
            'idgroup' => $this->request->getPost('idgroup'),
            'kategori' => $this->request->getPost('kategori'),
            'soal' => $this->request->getPost('soal'),
            'pilihana' => $this->request->getPost('pilihana'),
            'pilihanb' => $this->request->getPost('pilihanb'),
            'pilihanc' => $this->request->getPost('pilihanc'),
            'pilihand' => $this->request->getPost('pilihand'),
            'pilihane' => $this->request->getPost('pilihane'),
            'pilihanbenar' => $this->request->getPost('jawabanbenar'),
            'pointa' => $this->request->getPost('pointa'),
            'pointb' => $this->request->getPost('pointb'),
            'pointc' => $this->request->getPost('pointc'),
            'pointd' => $this->request->getPost('pointd'),
            'pointe' => $this->request->getPost('pointe'),
            'pointbenar' => $this->request->getPost('pointbenar'),
            'pembahasan' => $this->request->getPost('pembahasan'),
        );
        $this->DetailModel->kumpul_soal($data);
        session()->setFlashData('pesan', 'Data berhasil ditambah');
        return redirect()->to(base_url('gurusoal'));
    }

    public function editsoal($id_soal)
    {
        $data = array(
            'editsoal' => $this->DetailModel->link_edit_soal($id_soal),
            'title' => 'Edit Soal',
            'isi' => 'detail/v_edit_soal'
        );
        return view('layout/v_wrapper', $data);
    }

    public function proses_edit_soal($id_soal)
    {
        $data = array(
            'idsoal' => $id_soal,
            'kategori' => $this->request->getPost('kategori'),
            'soal' => $this->request->getPost('soal'),
            'pilihana' => $this->request->getPost('pilihana'),
            'pilihanb' => $this->request->getPost('pilihanb'),
            'pilihanc' => $this->request->getPost('pilihanc'),
            'pilihand' => $this->request->getPost('pilihand'),
            'pilihane' => $this->request->getPost('pilihane'),
            'pilihanbenar' => $this->request->getPost('jawabanbenar'),
            'pointa' => $this->request->getPost('pointa'),
            'pointb' => $this->request->getPost('pointb'),
            'pointc' => $this->request->getPost('pointc'),
            'pointd' => $this->request->getPost('pointd'),
            'pointe' => $this->request->getPost('pointe'),
            'pointbenar' => $this->request->getPost('pointbenar'),
            'pembahasan' => $this->request->getPost('pembahasan'),
        );
        $this->DetailModel->edit_soal($data);
        session()->setFlashData('pesan', 'Data berhasil diupdate');
        return redirect()->to(base_url('gurusoal'));
    }

    public function hapus_soal($id_soal)
    {
        $data = array(
            'idsoal' => $id_soal,
        );
        $this->DetailModel->hapus_soal($data);
        session()->setFlashData('pesan', 'Data berhasil dihapus');
        return redirect()->to(base_url('gurusoal'));
    }
}
