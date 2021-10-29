<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    public function tampil_data_user()
    {
        return $this->db->table("user")->orderBy('iduser', 'DESC')->get()->getResultArray();
    }

    public function tambah_user($data)
    {
        $this->db->table('user')->insert($data);
    }

    public function edit_user($data)
    {
        $this->db->table('user')->where('iduser', $data['iduser'])->update($data);
    }

    public function hapus_user($data)
    {
        $this->db->table('user')->where('iduser', $data['iduser'])->delete($data);
    }
}
