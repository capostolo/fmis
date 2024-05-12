<?php namespace Fmis\Models;

use CodeIgniter\Model;

class WorkTypeModel extends Model
{
  protected $DBGroup = 'fmis';
  protected $table      = 'work_type';
  protected $primaryKey = 'id';

  protected $useAutoIncrement = true;

  protected $returnType     = 'Fmis\Entities\WorkTypeEntity';
  protected $useSoftDeletes = false;

  protected $allowedFields = ['work_type_description', 
];

  protected $useTimestamps = false;

  /*
  public function modelList($where = null)
  {
    $builder = $this->db->table('work_type_list');
    if($where){
      $builder->where($where);
    }
    $query = $builder->get();
    return $query->getResult('Fmis\Entities\WorkTypeEntity');
  }
  */
}