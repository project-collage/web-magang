<?php

namespace App\Models;

use CodeIgniter\Model;

class HomeModel extends Model
{

    public function jml_group()
    {
        return $this->db->table('groupsoal')->countAll();
    }

    public function jml_guru()
    {
        return $this->db->table('user')->where('status', 'guru')->countAllResults();
    }

    public function jml_cpns()
    {
        return $this->db->table('user')->where('status', 'cpns')->countAllResults();
    }
    public function jml_pppk()
    {
        return $this->db->table('user')->where('status', 'pppk')->countAllResults();
    }
}
