<?php namespace Fmis\Models;

use CodeIgniter\Model;

class HarvestingEquipModel extends Model
{
  protected $DBGroup = 'fmis';
  protected $table      = 'harvesting_equip';
  protected $primaryKey = 'id';

  protected $useAutoIncrement = true;

  protected $useSoftDeletes = false;

  protected $allowedFields = ['harvesting_id',
  'harvest_equipment_id', 
];

  protected $useTimestamps = false;

  /*	
  public function modelList($where = null)
  {
    $builder = $this->db->table('harvesting_equip');
	$builder->select('harvest_equipment_id');
    if($where){
      $builder->where($where);
    }
    $query = $builder->get();
    return $query->getResultArray();
  }
  */
}