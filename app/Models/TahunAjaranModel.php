<?php

namespace App\Models;

use CodeIgniter\Model;

class TahunAjaranModel extends Model
{
    public function tampil_tahun_ajaran()
    {
        return $this->db->table("tahunajaran")->orderBy('idtahun', 'DESC')->get()->getResultArray();
    }

    public function tambah_tahun_ajaran($data)
    {
        $this->db->table('tahunajaran')->insert($data);
    }

    public function edit_tahun_ajaran($data)
    {
        $this->db->table('tahunajaran')->where('idtahun', $data['idtahun'])->update($data);
    }

    public function hapus_tahun_ajaran($data)
    {
        $this->db->table('tahunajaran')->where('idtahun', $data['idtahun'])->delete($data);
    }
}
