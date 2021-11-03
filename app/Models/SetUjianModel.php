<?php

namespace App\Models;

use CodeIgniter\Model;

class SetUjianModel extends Model
{
    public function tampil_ujian()
    {
        return $this->db->table("setujian")
            ->join('groupsoal', 'groupsoal.idgroup = setujian.idgroup', 'left')
            ->join('mapel', 'mapel.idmapel = groupsoal.idmapel', 'left')
            ->where('user', session()->get('iduser'))
            ->orderBy('idujian', 'ASC')
            ->get()->getResultArray();
    }

    public function tambah_ujian($data)
    {
        $this->db->table('setujian')->insert($data);
    }

    public function edit_ujian($data)
    {
        $this->db->table('setujian')->where('idujian', $data['idujian'])->update($data);
    }

    public function hapus_ujian($data)
    {
        $this->db->table('setujian')->where('idujian', $data['idujian'])->delete($data);
    }

    public function dropdown_group()
    {
        return $this->db->table('groupsoal')
            ->where('statusgrup', 'Y')
            ->orderBy('idgroup', 'ASC')
            ->get()->getResultArray();
    }
}
