<?php namespace Fmis\Models;

use CodeIgniter\Model;

class DoyModel extends Model
{
    protected $table      = 'param_doy';
    protected $primaryKey = 'doy_id';

    protected $useAutoIncrement = false;

    protected $returnType     = 'Fmis\Entities\DoyEntity';
    protected $useSoftDeletes = false;

    protected $allowedFields = [];

    protected $useTimestamps = false;
}