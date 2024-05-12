<?php namespace Fmis\Models;

use CodeIgniter\Model;

class PloughEquipmentModel extends Model
{
  protected $DBGroup = 'fmis';
  protected $table      = 'plough_equipment';
  protected $primaryKey = 'id';

  protected $useAutoIncrement = true;

  protected $returnType     = 'Fmis\Entities\PloughEquipmentEntity';
  protected $useSoftDeletes = false;

  protected $allowedFields = ['plough_equipment_description', 
'model_description', 
'hp', 
];

  protected $useTimestamps = false;

  /*
  public function modelList($where = null)
  {
    $builder = $this->db->table('plough_equipment_list');
    if($where){
      $builder->where($where);
    }
    $query = $builder->get();
    return $query->getResult('Fmis\Entities\PloughEquipmentEntity');
  }
  */
}