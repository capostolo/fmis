<?php namespace Fmis\Models;

use CodeIgniter\Model;

class PlantSpeciesSowModel extends Model
{
  protected $DBGroup = 'fmis';
  protected $table      = 'plant_species_sow';
  protected $primaryKey = 'id';

  protected $useAutoIncrement = true;

  protected $returnType     = 'Fmis\Entities\PlantSpeciesSowEntity';
  protected $useSoftDeletes = false;

  protected $allowedFields = ['plant_species_sow_description', 
];

  protected $useTimestamps = false;

  /*
  public function modelList($where = null)
  {
    $builder = $this->db->table('plant_species_sow_list');
    if($where){
      $builder->where($where);
    }
    $query = $builder->get();
    return $query->getResult('Fmis\Entities\PlantSpeciesSowEntity');
  }
  */
}