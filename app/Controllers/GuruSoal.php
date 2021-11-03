<?php

namespace App\Controllers;

use App\Models\GuruSoalModel;

use App\Models\GuruPelajaranModel;

class GuruSoal extends BaseController
{
    public function __construct()
    {
        $this->ModelGuruSoal = new GuruSoalModel();
        $this->ModelGuruPelajaran = new GuruPelajaranModel();
        helper('form');
    }

    public function index()
    {
        if (session()->get('status') <> "guru") {
            return redirect()->to(base_url('home'));
        }
        $data = array(
            'title' => 'Daftar Soal',
            'soal' => $this->ModelGuruSoal->tampil_guru_soal(),
            'dropdown_mapel' => $this->ModelGuruPelajaran->dropdown_mapel(),
            'guru_pelajaran' => $this->ModelGuruPelajaran->tampil_guru_pelajaran(),
            'isi' => 'groupsoal/v_guru_soal',
        );

        return view('layout/v_wrapper', $data);
    }

    public function tambah_group_soal()
    {
        $data = array(
            'idgurumapel' => $this->request->getPost('nama_guru'),
            'namagroup' => $this->request->getPost('group_soal'),
            'idmapel' => $this->request->getPost('mapel'),
        );
        $this->ModelGuruSoal->tambah_grup_soal($data);
        session()->setFlashData('pesan', 'Data berhasil ditambah');
        return redirect()->to(base_url('gurusoal'));
    }

    public function edit_group_soal($id_soal)
    {
        $data = array(
            'idgroup' => $id_soal,
            'namagroup' => $this->request->getPost('groupsoal'),
            'idmapel' => $this->request->getPost('mapel'),
        );
        $this->ModelGuruSoal->edit_group_soal($data);
        session()->setFlashData('pesan', 'Data berhasil diupdate');
        return redirect()->to(base_url('gurusoal'));
    }

    public function hapus_group_soal($id_soal)
    {
        $data = array(
            'idgroup' => $id_soal,
        );
        $this->ModelGuruSoal->hapus_group_soal($data);
        session()->setFlashData('pesan', 'Data berhasil dihapus');
        return redirect()->to(base_url('gurusoal'));
    }


    // public function detail($idgroup)
    // {
    //     $data = array(
    //         'detail' => $idgroup,
    //         'title' => 'Detail Soal',
    //         'isi' => 'detail/v_detail'

    //     );
    //     $this->ModelGroupSoal->tampil_detail($data);
    //     return view('layout/v_wrapper', $data);
    // }
}
