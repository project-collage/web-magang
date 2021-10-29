<?php

namespace App\Controllers;

use App\Models\MapelModel;

class Mapel extends BaseController
{
    public function __construct()
    {
        $this->ModelMapel = new MapelModel();
        helper('form');
    }

    public function index()
    {
        if (session()->get('status') <> "admin") {
            return redirect()->to(base_url('home'));
        }
        $data = array(
            'title' => 'Data Mapel',
            'mapel' => $this->ModelMapel->tampil_data(),
            'isi' => 'mapel/v_mapel',
        );

        return view('layout/v_wrapper', $data);
    }

    public function tambah_mapel()
    {
        $data = array(
            'kdmapel' => $this->request->getPost('kode_mapel'),
            'mapel' => $this->request->getPost('nama_mapel')
        );
        $this->ModelMapel->tambah_mapel($data);
        session()->setFlashData('pesan', 'Data berhasil ditambah');
        return redirect()->to(base_url('mapel'));
    }

    public function edit_mapel($id_mapel)
    {
        $data = array(
            'idmapel' => $id_mapel,
            'kdmapel' => $this->request->getPost('kdmapel'),
            'mapel' => $this->request->getPost('nama_mapel')
        );
        $this->ModelMapel->edit_mapel($data);
        session()->setFlashData('pesan', 'Data berhasil diupdate');
        return redirect()->to(base_url('mapel'));
    }

    public function hapus_mapel($id_mapel)
    {
        $data = array(
            'idmapel' => $id_mapel,
        );
        $this->ModelMapel->hapus_mapel($data);
        session()->setFlashData('pesan', 'Data berhasil dihapus');
        return redirect()->to(base_url('mapel'));
    }
}
