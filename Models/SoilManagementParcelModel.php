<?php namespace Fmis\Models;

use CodeIgniter\Model;

class SoilManagementParcelModel extends Model
{
  protected $DBGroup = 'fmis';
  protected $table      = 'soil_management_parcel';
  protected $primaryKey = 'id';

  protected $useAutoIncrement = true;

  protected $returnType     = 'Fmis\Entities\SoilManagementParcelEntity';
  protected $useSoftDeletes = false;

  protected $allowedFields = ['soil_management_id', 
                              'parcel_id', 
                              'soil_management_date', 
                              'work_type_id', 
                              'purpose_description', 
                              'biodiversity_zone', 
                              'plant_species_sow_id', 
                              'seed_needed', 
                              'cover_crop_species_id', 
                              'cover_crop_seed', 
                              'farming_stage_id', 
                              'plough_equipment_id', 
                              'carbon_footprint', 
                            ];

  protected $useTimestamps = false;

  public function modelList($where = null)
  {
    $builder = $this->db->table('soil_management_parcel_list');
    if($where){
      $builder->where($where);
    }
    $query = $builder->get();
    return $query->getResult('Fmis\Entities\SoilManagementParcelEntity');
  }
}