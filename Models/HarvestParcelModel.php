<?php namespace Fmis\Models;

use CodeIgniter\Model;

class HarvestParcelModel extends Model
{
  protected $DBGroup = 'fmis';
  protected $table      = 'harvest_parcel';
  protected $primaryKey = 'id';

  protected $useAutoIncrement = true;

  protected $returnType     = 'Fmis\Entities\HarvestParcelEntity';
  protected $useSoftDeletes = false;

  protected $allowedFields = ['harvesting_id', 
                              'parcel_id', 
                              'harvest_date', 
                              'harvest_equipment_id', 
                              'olive_fruit_weight', 
                              'olive_oil_weight', 
                              'acidity', 
                              'carbon_footprint', 
                            ];

  protected $useTimestamps = false;

  public function modelList($where = null)
  {
    $builder = $this->db->table('harvest_parcel_list');
    if($where){
      $builder->where($where);
    }
    $query = $builder->get();
    return $query->getResult('Fmis\Entities\HarvestParcelEntity');
  }
}