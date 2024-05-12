<?php namespace Fmis\Models;

use CodeIgniter\Model;

class HarvestEquipmentModel extends Model
{
  protected $DBGroup = 'fmis';
  protected $table      = 'harvest_equipment';
  protected $primaryKey = 'id';

  protected $useAutoIncrement = true;

  protected $returnType     = 'Fmis\Entities\HarvestEquipmentEntity';
  protected $useSoftDeletes = false;

  protected $allowedFields = ['harvest_equipment_description', 
'model_description', 
'hp', 
];

  protected $useTimestamps = false;

  /*
  public function modelList($where = null)
  {
    $builder = $this->db->table('harvest_equipment_list');
    if($where){
      $builder->where($where);
    }
    $query = $builder->get();
    return $query->getResult('Fmis\Entities\HarvestEquipmentEntity');
  }
  */
}