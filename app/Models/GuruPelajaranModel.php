<?php

namespace App\Models;

use CodeIgniter\Model;

class GuruPelajaranModel extends Model
{
    public function tampil_guru_pelajaran()
    {
        return $this->db->table("gurumapel")
            ->join('mapel', 'mapel.idmapel = gurumapel.idmapel', 'left')
            ->join('user', 'user.iduser = gurumapel.iduser', 'left')
            ->join('tahunajaran', 'tahunajaran.idtahun = gurumapel.idtahun', 'left')
            ->orderBy('idgurumapel', 'ASC')
            ->get()->getResultArray();
    }

    public function dropdown_guru()
    {
        return $this->db->table("user")
            ->where('status', 'guru')
            ->orderBy('iduser', 'DESC')
            ->get()->getResultArray();
    }

    public function dropdown_mapel()
    {
        return $this->db->table("mapel")
            ->orderBy('idmapel', 'DESC')
            ->get()->getResultArray();
    }

    public function dropdown_tahun()
    {
        return $this->db->table("tahunajaran")
            ->orderBy('idtahun', 'DESC')
            ->get()->getResultArray();
    }

    public function tambah_guru_pelajaran($data)
    {
        $this->db->table('gurumapel')->insert($data);
    }

    public function edit_guru_pelajaran($data)
    {
        $this->db->table('gurumapel')->where('idgurumapel', $data['idgurumapel'])->update($data);
    }

    public function hapus_guru_pelajaran($data)
    {
        $this->db->table('gurumapel')->where('idgurumapel', $data['idgurumapel'])->delete($data);
    }
}
