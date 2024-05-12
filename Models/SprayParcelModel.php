<?php namespace Fmis\Models;

use CodeIgniter\Model;

class SprayParcelModel extends Model
{
  protected $DBGroup = 'fmis';
  protected $table      = 'spray_parcel';
  protected $primaryKey = 'id';

  protected $useAutoIncrement = true;

  protected $returnType     = 'Fmis\Entities\SprayParcelEntity';
  protected $useSoftDeletes = false;

  protected $allowedFields = ['spray_id', 
                              'parcel_id', 
                              'spray_date', 
                              'protective_product_id', 
                              'dose', 
                              'unit_measurement_id',
                              'parcel_quantity',
                              'target', 
                              'conditions', 
                              'days_before_harvest', 
                              'farming_stage_id', 
                              'spray_equipment_id', 
                              'carbon_footprint', 
                            ];

  protected $useTimestamps = false;

  public function modelList($where = null)
  {
    $builder = $this->db->table('spray_parcel_list');
    if($where){
      $builder->where($where);
    }
    $query = $builder->get();
    return $query->getResult('Fmis\Entities\SprayParcelEntity');
  }

}