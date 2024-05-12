<?php namespace Fmis\Models;

use CodeIgniter\Model;

class PruningEquipmentModel extends Model
{
  protected $DBGroup = 'fmis';
  protected $table      = 'pruning_equipment';
  protected $primaryKey = 'id';

  protected $useAutoIncrement = true;

  protected $returnType     = 'Fmis\Entities\PruningEquipmentEntity';
  protected $useSoftDeletes = false;

  protected $allowedFields = ['pruning_equipment_description', 
];

  protected $useTimestamps = false;

  /*
  public function modelList($where = null)
  {
    $builder = $this->db->table('pruning_equipment_list');
    if($where){
      $builder->where($where);
    }
    $query = $builder->get();
    return $query->getResult('Fmis\Entities\PruningEquipmentEntity');
  }
  */
}