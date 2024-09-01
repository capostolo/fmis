<?php namespace Fmis\Models;

use CodeIgniter\Model;

class ParamSoModel extends Model
{
    protected $DBGroup = 'fmis';
    protected $table = 'param_so';
    protected $primaryKey = 'poi_id';
    protected $returnType = 'Fmis\Entities\ParamSoEntity';
    protected $allowedFields = [];

    protected $useTimestamps = false;

    // Add any additional methods you need here
}