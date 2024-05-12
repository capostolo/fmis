<?php namespace Fmis\Models;

use CodeIgniter\Model;

class SprayEquipmentModel extends Model
{
  protected $DBGroup = 'fmis';
  protected $table      = 'spray_equipment';
  protected $primaryKey = 'id';

  protected $useAutoIncrement = true;

  protected $returnType     = 'Fmis\Entities\SprayEquipmentEntity';
  protected $useSoftDeletes = false;

  protected $allowedFields = ['spray_equipment_description', 
'model_description', 
'hp', 
'capacity', 
];

  protected $useTimestamps = false;

  /*
  public function modelList($where = null)
  {
    $builder = $this->db->table('spray_equipment_list');
    if($where){
      $builder->where($where);
    }
    $query = $builder->get();
    return $query->getResult('Fmis\Entities\SprayEquipmentEntity');
  }
  */
}