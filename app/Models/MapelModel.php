<?php

namespace App\Models;

use CodeIgniter\Model;

class MapelModel extends Model
{
    public function tampil_data()
    {
        return $this->db->table("mapel")->orderBy('idmapel', 'ASC')->get()->getResultArray();
    }

    public function tambah_mapel($data)
    {
        $this->db->table('mapel')->insert($data);
    }

    public function edit_mapel($data)
    {
        $this->db->table('mapel')->where('idmapel', $data['idmapel'])->update($data);
    }

    public function hapus_mapel($data)
    {
        $this->db->table('mapel')->where('idmapel', $data['idmapel'])->delete($data);
    }
}
