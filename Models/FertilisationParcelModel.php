<?php namespace Fmis\Models;

use CodeIgniter\Model;

class FertilisationParcelModel extends Model
{
  protected $DBGroup = 'fmis';
  protected $table      = 'fertilisation_parcel';
  protected $primaryKey = 'id';

  protected $useAutoIncrement = true;

  protected $returnType     = 'Fmis\Entities\FertilisationParcelEntity';
  protected $useSoftDeletes = false;

  protected $allowedFields = ['fertilisation_id', 
                              'fertilisation_date', 
                              'fertiliser_id', 
                              'parcel_id', 
                              'quantity_description', 
                              'unit_measurement_id', 
                              'fertiliser_application_id', 
                              'farming_stage_id', 
                              'fertilise_equipment_id', 
                              'specialised_fertiliser_id',
							  'total_quantity',
                              'carbon_footprint', 
                            ];

  protected $useTimestamps = false;

  public function modelList($where = null)
  {
    $builder = $this->db->table('fertilisation_parcel_list');
    if($where){
      $builder->where($where);
    }
    $query = $builder->get();
    return $query->getResult('Fmis\Entities\FertilisationParcelEntity');
  }
}