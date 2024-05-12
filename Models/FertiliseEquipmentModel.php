<?php namespace Fmis\Models;

use CodeIgniter\Model;

class FertiliseEquipmentModel extends Model
{
  protected $DBGroup = 'fmis';
  protected $table      = 'fertilise_equipment';
  protected $primaryKey = 'id';

  protected $useAutoIncrement = true;

  protected $returnType     = 'Fmis\Entities\FertiliseEquipmentEntity';
  protected $useSoftDeletes = false;

  protected $allowedFields = ['fertilise_equipment_description', 
'model_description', 
'hp', 
'capacity', 
];

  protected $useTimestamps = false;

  /*
  public function modelList($where = null)
  {
    $builder = $this->db->table('fertilise_equipment_list');
    if($where){
      $builder->where($where);
    }
    $query = $builder->get();
    return $query->getResult('Fmis\Entities\FertiliseEquipmentEntity');
  }
  */
}