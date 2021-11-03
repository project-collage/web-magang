<?php

namespace App\Controllers;

use App\Models\HomeModel;

class Home extends BaseController
{
	public function __construct()
	{
		$this->HomeModel = new HomeModel();
	}

	public function index()
	{
		$data = array(
			'title' => 'Dashboard',
			'tot_group' => $this->HomeModel->jml_group(),
			'tot_guru' => $this->HomeModel->jml_guru(),
			'tot_cpns' => $this->HomeModel->jml_cpns(),
			'tot_pppk' => $this->HomeModel->jml_pppk(),
			'tot_ujian' => $this->HomeModel->jml_ujian(),
			'isi' => 'v_home',
		);

		return view('layout/v_wrapper', $data);
	}
}
