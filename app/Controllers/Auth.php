<?php

namespace App\Controllers;

use App\Models\AuthModel;

class Auth extends BaseController
{
    public function __construct()
    {
        helper('form');
        $this->AuthModel = new AuthModel();
    }

    public function register()
    {
        $data = array(
            'title' => 'Register'
        );
        return view('register/v_register', $data);
    }

    public function save_register()
    {
        if ($this->validate([
            'username' => [
                'label' => 'username',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib diisi'
                ]
            ],
            'password' => [
                'label' => 'password',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib diisi'
                ]
            ],
            'namauser' => [
                'label' => 'namauser',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib diisi'
                ]
            ],
            'status' => [
                'label' => 'namauser',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib diisi'
                ]
            ],
        ])) {
            $pw = base64_encode($this->request->getPost('password'));
            $data = array(
                'username' => $this->request->getPost('username'),
                'password' => $pw,
                'namauser' => $this->request->getPost('namauser'),
                'status' => 'cpns'
            );
            $this->AuthModel->save_register($data);
            session()->setFlashData('pesan', 'Register berhasil');
            return redirect()->to(base_url('auth/register'));
        } else {
            session()->setFlashData('errors', \Config\Services::validation()->getErrors());
            return redirect()->to(base_url('auth/register'));
        }
    }

    public function login()
    {
        $data = array(
            'title' => 'Login'
        );
        return view('login/v_login', $data);
    }

    public function cek_login()
    {
        if ($this->validate([
            'username' => [
                'label' => 'username',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib diisi'
                ]
            ],
            'password' => [
                'label' => 'password',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib diisi'
                ]
            ]
        ])) {
            $pw = base64_encode($this->request->getPost('password'));
            $username = $this->request->getPost('username');
            $password = $pw;
            $cek = $this->AuthModel->login($username, $password);
            if ($cek) {
                session()->set('log', true);
                session()->set('username', $cek['username']);
                session()->set('namauser', $cek['namauser']);
                session()->set('iduser', $cek['iduser']);
                session()->set('status', $cek['status']);
                return redirect()->to(base_url('home'));
            } else {
                session()->setFlashData('pesan', 'Login gagal');
                return redirect()->to(base_url('auth/login'));
            }
        } else {
            // session()->setFlashData('errors', \Config\Services::validation()->getErrors());
            // return redirect()->to(base_url('auth/register'));
        }
    }

    public function logout()
    {
        session()->remove('log');
        session()->remove('username');
        return redirect()->to(base_url('auth/login'));
    }
}
