<?php namespace Fmis\Models;

use CodeIgniter\Model;

class IrrigationParcelModel extends Model
{
  protected $DBGroup = 'fmis';
  protected $table      = 'irrigation_parcel';
  protected $primaryKey = 'id';

  protected $useAutoIncrement = true;

  protected $returnType     = 'Fmis\Entities\IrrigationParcelEntity';
  protected $useSoftDeletes = false;

  protected $allowedFields = ['irrigation_id', 
                              'parcel_id', 
                              'irrigation_date',
                              'water_quantity_description', 
                              'unit_measurement_id', 
                              'suppling_hours', 
                              'farming_stage_id', 
                              'irrigation_equipment_id', 
                              'carbon_footprint', 
                            ];

  protected $useTimestamps = false;

  public function modelList($where = null)
  {
    $builder = $this->db->table('irrigation_parcel_list');
    if($where){
      $builder->where($where);
    }
    $query = $builder->get();
    return $query->getResult('Fmis\Entities\IrrigationParcelEntity');
  }
}