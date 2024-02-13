<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelObatRacikan extends Model
{
    protected $table = 'farmasi_obat_racikan_rme';
    protected $primaryKey = 'id';

    protected $allowedFields = ['journalnumber', 'referencenumber', 'pasienid', 'pasienname', 'description', 'created_by'];

    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
};
