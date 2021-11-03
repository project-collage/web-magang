<?php

namespace App\Controllers;

use App\Models\GroupSoalModel;

class GroupSoal extends BaseController
{
    public function __construct()
    {
        $this->ModelGroupSoal = new GroupSoalModel();
        helper('form');
    }

    public function index()
    {
        if (session()->get('status') <> "admin") {
            return redirect()->to(base_url('home'));
        }
        $data = array(
            'title' => 'Group Soal',
            'soal' => $this->ModelGroupSoal->tampil_group_soal(),
            'isi' => 'groupsoal/v_group_soal',
        );

        return view('layout/v_wrapper', $data);
    }

    public function verifikasi_group_soal($id_soal)
    {
        $data = array(
            'idgroup' => $id_soal,
            'statusgrup' => $this->request->getPost('status')
        );
        $this->ModelGroupSoal->verifikasi_group_soal($data);
        session()->setFlashData('pesan', 'Data berhasil diupdate');
        return redirect()->to(base_url('groupsoal'));
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
