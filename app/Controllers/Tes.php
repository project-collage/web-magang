<?php

namespace App\Controllers;

class Tes extends BaseController
{
    public function __construct()
    {

        helper('form');
    }

    public function index()
    {

        $data = array(
            'title' => 'Ujian',
            'isi' => 'tes/v_tes',
        );

        return view('layout/v_wrapper', $data);
    }
}
