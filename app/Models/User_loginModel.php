<?php

namespace App\Models;

use CodeIgniter\Model;

class User_loginModel extends Model
{
    protected $table = 'userss';
    protected $primaryKey = 'id';
    protected $allowedFields = ['username', 'email', 'password', 'reset_token', 'role'];
    protected $useTimestamps = true;
    protected $useAutoIncrement = true;
    protected $createdField = 'create_at';
    // protected $createField = 'create_att';
    protected $updatedField = 'update_at';
    // protected $dataFormat = 'datetime';
    protected $dataFormat = 'timestamp';

    // public function login($post)
    // {
    //     $this->db->select('*');
    //     $this->db->from('userss');
    // }


    // Add any necessary functions for user handling, e.g., registerUser, getUserByUsername, etc.
}
