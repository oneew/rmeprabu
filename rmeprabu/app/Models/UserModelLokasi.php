<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModelLokasi extends Model
{
    protected $table = 'userslocation';
    protected $primaryKey = 'id';
    protected $allowedFields = ['firstname', 'email', 'password', 'created_at', 'updated_at', 'locationname', 'locationcode', 'createdby', 'ip'];
    protected $beforeInsert = ['beforeInsert'];
    protected $beforeUpdate = ['beforeUpdate'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    protected function beforeInsert(array $data)
    {
        $data = $this->passwordHash($data);
        return $data;
    }


    protected function beforeUpdate(array $data)
    {
        $data = $this->passwordHash($data);

        return $data;
    }

    protected function passwordHash(array $data)
    {
        if (isset($data['data']['password']))

            $data['data']['password'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);

        return $data;
    }


    function ambillog()
    {
        $this->dt = $this->db->table('logreborn2023');
        $this->dt->where('email', session()->get('email'));
        $this->dt->orderBy('id', 'DESC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function ambilactivity()
    {
        $this->dt = $this->db->table('logreborn2023activity');
        $this->dt->where('email', session()->get('email'));
        $this->dt->orderBy('id', 'DESC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function ambildatauser()
    {
        $this->dt = $this->db->table('users');
        $this->dt->orderBy('firstname', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function ambildatid($id)
    {
        $this->dt = $this->db->table('users');
        $this->dt->where('id', $id);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_list_lokasi()
    {
        $this->dt = $this->db->table('gudang');
        $this->dt->select(' code ,  name, id ');
        $this->dt->where('room', '1');
        $this->dt->where('inactive', 'TIDAK');
        $this->dt->orderBy('name');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_list_lokasi_after($email)
    {
        $this->dt = $this->db->table('userslocation');
        $this->dt->where('email', $email);
        $this->dt->orderBy('id', 'DESC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_id($email)
    {
        $this->dt = $this->db->table('users');
        $this->dt->where('email', $email);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function ambildataactivity()
    {
        $this->dt = $this->db->table('logreborn2023activity');
        $this->dt->where('dateactivity', date('Y-m-d'));
        $this->dt->orderBy('id', 'DESC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_activity($search)
    {
        $this->dt = $this->db->table('logreborn2023activity');
        $this->dt->where('dateactivity >=', $search['mulai']);
        $this->dt->where('dateactivity <=', $search['sampai']);
        $this->dt->orderBy('id', 'DESC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_list_lokasi_all()
    {
        $this->dt = $this->db->table('gudang');
        $this->dt->select(' code ,  name, id ');
        //$this->dt->where('room', '1');
        $this->dt->where('inactive', 'TIDAK');
        $this->dt->orderBy('name');
        $query = $this->dt->get();
        return $query->getResultArray();
    }
}
