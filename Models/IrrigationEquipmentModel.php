<?php namespace Fmis\Models;

use CodeIgniter\Model;

class IrrigationEquipmentModel extends Model
{
  protected $DBGroup = 'fmis';
  protected $table      = 'irrigation_equipment';
  protected $primaryKey = 'id';

  protected $useAutoIncrement = true;

  protected $returnType     = 'Fmis\Entities\IrrigationEquipmentEntity';
  protected $useSoftDeletes = false;

  protected $allowedFields = ['irrigation_equipment_description', 
'model_description', 
'hp', 
'volumetric_flow_rate', 
];

  protected $useTimestamps = false;

  /*
  public function modelList($where = null)
  {
    $builder = $this->db->table('irrigation_equipment_list');
    if($where){
      $builder->where($where);
    }
    $query = $builder->get();
    return $query->getResult('Fmis\Entities\IrrigationEquipmentEntity');
  }
  */
}