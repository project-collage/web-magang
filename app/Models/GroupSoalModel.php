<?php

namespace App\Models;

use CodeIgniter\Model;

class GroupSoalModel extends Model
{
    public function tampil_group_soal()
    {
        return $this->db->table("groupsoal")
            ->join('gurumapel', 'gurumapel.idgurumapel = groupsoal.idgurumapel', 'left')
            ->join('user', 'user.iduser = gurumapel.iduser', 'left')
            ->join('tahunajaran', 'tahunajaran.idtahun = gurumapel.idtahun', 'left')
            ->join('mapel', 'mapel.idmapel = groupsoal.idmapel', 'left')
            ->orderBy('idgroup', 'ASC')
            ->get()->getResultArray();
    }

    public function tampil_group_soal1()
    {
        return $this->db->table("setujian")
            ->join('groupsoal', 'groupsoal.idgroup = setujian.idgroup', 'left')
            ->join('gurumapel', 'gurumapel.idgurumapel = groupsoal.idgurumapel', 'left')
            ->join('user', 'user.iduser = gurumapel.iduser', 'left')
            ->join('tahunajaran', 'tahunajaran.idtahun = gurumapel.idtahun', 'left')
            ->join('mapel', 'mapel.idmapel = groupsoal.idmapel', 'left')
            ->orderBy('idujian', 'ASC')
            ->get()->getResultArray();
    }
    public function tampil_detail($data)
    {
        return $this->db->table("soal")->where('idgroup', $data['detail'])
            ->get()->getResultArray();
        // $sql = "SELECT * FROM groupsoal WHERE idgroup='$idgroup'";
        // $query = $this->db->query($sql);
        // $data = $query->getResultArray();
        // return $data;
    }

    public function edit_group_soal($data)
    {
        $this->db->table('groupsoal')->where('idgroup', $data['idgroup'])->update($data);
    }
}
