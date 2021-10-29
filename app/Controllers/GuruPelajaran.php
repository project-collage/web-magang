<?php

namespace App\Controllers;

use App\Models\GuruPelajaranModel;

class GuruPelajaran extends BaseController
{
    public function __construct()
    {
        $this->ModelGuruPelajaran = new GuruPelajaranModel();
        helper('form');
    }

    public function index()
    {
        if (session()->get('status') <> "admin") {
            return redirect()->to(base_url('home'));
        }
        $data = array(
            'title' => 'Data Guru Mapel',
            'guru' => $this->ModelGuruPelajaran->tampil_guru_pelajaran(),
            'dropdown_guru' => $this->ModelGuruPelajaran->dropdown_guru(),
            'dropdown_mapel' => $this->ModelGuruPelajaran->dropdown_mapel(),
            'dropdown_tahun' => $this->ModelGuruPelajaran->dropdown_tahun(),
            'isi' => 'guru_pelajaran/v_guru_pelajaran',
        );

        return view('layout/v_wrapper', $data);
    }

    public function tambah_guru_pelajaran()
    {
        $data = array(
            'iduser' => $this->request->getPost('namaguru'),
            'idmapel' => $this->request->getPost('mapel'),
            'idtahun' => $this->request->getPost('tahun'),
        );
        $this->ModelGuruPelajaran->tambah_guru_pelajaran($data);
        session()->setFlashData('pesan', 'Data berhasil ditambah');
        return redirect()->to(base_url('gurupelajaran'));
    }

    public function edit_guru_pelajaran($id_guru)
    {
        $data = array(
            'idgurumapel' => $id_guru,
            'iduser' => $this->request->getPost('namaguru'),
            'idmapel' => $this->request->getPost('mapel'),
            'idtahun' => $this->request->getPost('tahun')
        );
        $this->ModelGuruPelajaran->edit_guru_pelajaran($data);
        session()->setFlashData('pesan', 'Data berhasil diupdate');
        return redirect()->to(base_url('gurupelajaran'));
    }

    public function hapus_guru_pelajaran($id_guru)
    {
        $data = array(
            'idgurumapel' => $id_guru,
        );
        $this->ModelGuruPelajaran->hapus_guru_pelajaran($data);
        session()->setFlashData('pesan', 'Data berhasil dihapus');
        return redirect()->to(base_url('gurupelajaran'));
    }
}
