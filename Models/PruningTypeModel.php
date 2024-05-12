<?php namespace Fmis\Models;

use CodeIgniter\Model;

class PruningTypeModel extends Model
{
  protected $DBGroup = 'fmis';
  protected $table      = 'pruning_type';
  protected $primaryKey = 'id';

  protected $useAutoIncrement = true;

  protected $returnType     = 'Fmis\Entities\PruningTypeEntity';
  protected $useSoftDeletes = false;

  protected $allowedFields = ['pruning_type_description', 
];

  protected $useTimestamps = false;

  /*
  public function modelList($where = null)
  {
    $builder = $this->db->table('pruning_type_list');
    if($where){
      $builder->where($where);
    }
    $query = $builder->get();
    return $query->getResult('Fmis\Entities\PruningTypeEntity');
  }
  */
}