<?php

namespace App\Models;

use CodeIgniter\Model;

class DaftarUjianModel extends Model
{
    public function tampil_ujian()
    {
        return $this->db->table("setujian")
            ->join('groupsoal', 'groupsoal.idgroup = setujian.idgroup', 'left')
            ->join('mapel', 'mapel.idmapel = groupsoal.idmapel', 'left')
            ->where('setujian.status', 'aktif')
            ->orderBy('idujian', 'ASC')
            ->get()->getResultArray();
    }
}
