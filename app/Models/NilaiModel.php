<?php

namespace App\Models;

use CodeIgniter\Model;

class NilaiModel extends Model
{
    public function tampil_data_nilai_admin()
    {
        return $this->db->table("setujian")
            ->join('groupsoal', 'groupsoal.idgroup =  setujian.idgroup', 'left')
            ->join('gurumapel', 'gurumapel.idgurumapel =  groupsoal.idgurumapel', 'left')
            ->join('mapel', 'mapel.idmapel =  groupsoal.idmapel', 'left')
            ->orderBy('idujian', 'ASC')
            ->get()->getResultArray();
    }

    public function tampil_data_nilai_guru()
    {
        return $this->db->table("setujian")
            ->join('groupsoal', 'groupsoal.idgroup =  setujian.idgroup', 'left')
            ->join('gurumapel', 'gurumapel.idgurumapel =  groupsoal.idgurumapel', 'left')
            ->join('mapel', 'mapel.idmapel =  groupsoal.idmapel', 'left')
            ->where('setujian.user', session()->get('iduser'))
            ->orderBy('idujian', 'ASC')
            ->get()->getResultArray();
    }

    public function tampil_nilai_peserta()
    {
        return $this->db->table("nilai")
            ->join('user', 'user.iduser = nilai.iduser', 'left')
            ->join('setujian', 'setujian.idujian = nilai.idujian', 'left')
            ->join('groupsoal', 'groupsoal.idgroup = setujian.idgroup', 'left')
            ->join('gurumapel', 'gurumapel.idgurumapel = groupsoal.idgurumapel', 'left')
            ->join('mapel', 'mapel.idmapel = gurumapel.idmapel', 'left')
            ->orderBy('idnilai', 'ASC')
            ->get()->getResultArray();
    }

    public function hapus_nilai($data)
    {
        $this->db->table('nilai')->where('idnilai', $data['idnilai'])->delete($data);
    }
}
