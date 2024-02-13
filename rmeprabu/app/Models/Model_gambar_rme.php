<?php

namespace App\Models;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\Model;

class Model_gambar_rme extends Model
{

    protected $table = "data_gambar_rme";
    protected $primaryKey = 'id';
    protected $allowedFields = ['referencenumber', 'type', 'nama_file'];

}