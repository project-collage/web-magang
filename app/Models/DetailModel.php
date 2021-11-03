<?php

namespace App\Models;

use CodeIgniter\Model;

class DetailModel extends Model
{
    public function detail_soal($id_group)
    {
        return $this->db->table("soal")
            ->join('groupsoal', 'groupsoal.idgroup = soal.idgroup', 'left')
            ->where('groupsoal.idgroup', $id_group)
            ->orderBy('idsoal', 'ASC')
            ->get()->getResultArray();
    }

    public function tambah_soal($id_group)
    {
        return $this->db->table("groupsoal")
            ->where('groupsoal.idgroup', $id_group)
            ->orderBy('idgroup', 'ASC')
            ->get()->getResultArray();
    }

    public function link_edit_soal($id_soal)
    {
        return $this->db->table("soal")
            ->where('soal.idsoal', $id_soal)
            ->orderBy('idsoal', 'ASC')
            ->get()->getResultArray();
    }

    public function kumpul_soal($data)
    {
        $this->db->table('soal')->insert($data);
    }

    public function edit_soal($data)
    {
        $this->db->table('soal')->where('idsoal', $data['idsoal'])->update($data);
    }

    public function hapus_soal($data)
    {
        $this->db->table('soal')->where('idsoal', $data['idsoal'])->delete($data);
    }
}
