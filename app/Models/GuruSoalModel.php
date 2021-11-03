<?php

namespace App\Models;

use CodeIgniter\Model;

class GuruSoalModel extends Model
{
    public function tampil_guru_soal()
    {
        return $this->db->table("groupsoal")
            ->join('gurumapel', 'gurumapel.idgurumapel = groupsoal.idgurumapel', 'left')
            ->join('tahunajaran', 'tahunajaran.idtahun = gurumapel.idtahun', 'left')
            ->join('mapel', 'mapel.idmapel = groupsoal.idmapel', 'left')
            ->join('user', 'user.iduser = gurumapel.iduser', 'left')
            ->where('user.iduser', session()->get('iduser'))
            ->orderBy('idgroup', 'ASC')
            ->get()->getResultArray();
    }

    public function tambah_grup_soal($data)
    {
        $this->db->table('groupsoal')->insert($data);
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

    public function hapus_group_soal($data)
    {
        $this->db->table('groupsoal')->where('idgroup', $data['idgroup'])->delete($data);
    }
}
