<?php namespace Fmis\Models;

use CodeIgniter\Model;

class ParamCatsoModel extends Model
{
    protected $DBGroup = 'fmis';
    protected $table = 'param_catso';
    protected $primaryKey = 'poiCategory';
    protected $returnType = 'Fmis\Entities\ParamCatsoEntity';
    protected $allowedFields = [];

    protected $useTimestamps = false;

    // Add any additional methods you need here
}