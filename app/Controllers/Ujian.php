<?php

namespace App\Controllers;

class Ujian extends BaseController
{
    public function index()
    {
        $data = array(
            // 'soal' => $this->request->getPost('soal'),
            'title' => 'Data Ujian',
            'isi' => 'ujian/v_ujian',
        );

        return view('layout/v_wrapper', $data);
    }

    public function proseseditjawaban()
    {
        $mysqli = \Config\Database::connect('default');
        // $pilihan = $this->request->getPost('pilihan');
        // echo $pilihan = implode(', ', $_POST['pilihan']);
        //echo $pilihan = implode($_POST["pilihan"], ', ');
        $idjawab = $this->request->getPost('idjawab');
        $halaman = $this->request->getPost('halaman');
        $page = $this->request->getPost('page');
        $no = $this->request->getPost('soal');

        $mysqli->query("update jawaban set 

jawaban = 'a' 
where idjawab = '$idjawab'
");

        if ($halaman == $page) {
            return redirect()->to('ujian/' . $page);
        } else {
            return redirect()->to('ujian/' . $page);
        }
    }
}
