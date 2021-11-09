<?php

namespace App\Models;

use CodeIgniter\Model;

class UjianModel extends Model
{
    public function proses_ujian($data)
    {
        return $this->db->table("nilai")
            ->where('iduser', session()->get('iduser'))
            ->where('idujian', $data['idujian'])
            ->orderBy('iduser', 'DESC')->get()->getResultArray();
    }
}
