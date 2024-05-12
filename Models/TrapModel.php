<?php namespace Fmis\Models;

use CodeIgniter\Model;

class TrapModel extends Model
{
  protected $DBGroup = 'fmis';
  protected $table      = 'trap';
  protected $primaryKey = 'id';

  protected $useAutoIncrement = true;

  protected $returnType     = 'Fmis\Entities\TrapEntity';
  protected $useSoftDeletes = false;

  protected $allowedFields = ['trap_description', 
'active_substance', 
'traps_hectare', 
];

  protected $useTimestamps = false;

  /*
  public function modelList($where = null)
  {
    $builder = $this->db->table('trap_list');
    if($where){
      $builder->where($where);
    }
    $query = $builder->get();
    return $query->getResult('Fmis\Entities\TrapEntity');
  }
  */
}