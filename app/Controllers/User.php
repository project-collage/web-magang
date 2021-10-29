<?php

namespace App\Controllers;

use App\Models\UserModel;

class User extends BaseController
{
    public function __construct()
    {
        $this->ModelUser = new UserModel();
        helper('form');
    }

    public function index()
    {
        if (session()->get('status') <> "admin") {
            return redirect()->to(base_url('home'));
        }
        $data = array(
            'title' => 'Data User',
            'user' => $this->ModelUser->tampil_data_user(),
            'isi' => 'user/v_user',
        );

        return view('layout/v_wrapper', $data);
    }

    public function tambah_user()
    {
        $password = base64_encode($this->request->getPost('password'));

        $data = array(
            'namauser' => $this->request->getPost('nama_user'),
            'jk' => $this->request->getPost('jk'),
            'tempatlahir' => $this->request->getPost('tempatlahir'),
            'tgllahir' => $this->request->getPost('tgllahir'),
            'tgllahir' => $this->request->getPost('tgllahir'),
            'status' => $this->request->getPost('status'),
            'username' => $this->request->getPost('username'),
            'password' => $password
        );
        $this->ModelUser->tambah_user($data);
        session()->setFlashData('pesan', 'Data berhasil ditambah');
        return redirect()->to(base_url('user'));
    }

    public function edit_user($id_user)
    {
        $password = base64_encode($this->request->getPost('password'));

        $data = array(
            'iduser' => $id_user,
            'namauser' => $this->request->getPost('nama_user'),
            'jk' => $this->request->getPost('jk'),
            'tempatlahir' => $this->request->getPost('tempatlahir'),
            'tgllahir' => $this->request->getPost('tgllahir'),
            'tgllahir' => $this->request->getPost('tgllahir'),
            'status' => $this->request->getPost('status'),
            'username' => $this->request->getPost('username'),
            'password' => $password
        );
        $this->ModelUser->edit_user($data);
        session()->setFlashData('pesan', 'Data berhasil diupdate');
        return redirect()->to(base_url('user'));
    }

    public function hapus_user($id_user)
    {
        $data = array(
            'iduser' => $id_user,
        );
        $this->ModelUser->hapus_user($data);
        session()->setFlashData('pesan', 'Data berhasil dihapus');
        return redirect()->to(base_url('user'));
    }
}
