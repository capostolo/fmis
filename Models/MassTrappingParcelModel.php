<?php namespace Fmis\Models;

use CodeIgniter\Model;

class MassTrappingParcelModel extends Model
{
  protected $DBGroup = 'fmis';
  protected $table      = 'mass_trapping_parcel';
  protected $primaryKey = 'id';

  protected $useAutoIncrement = true;

  protected $returnType     = 'Fmis\Entities\MassTrappingParcelEntity';
  protected $useSoftDeletes = false;

  protected $allowedFields = ['mass_trapping_id', 
                              'parcel_id', 
                              'mass_trapping_date', 
                              'trap_id', 
                              'traps_hectare', 
                              'farming_stage_id', 
                              'carbon_footprint', 
                            ];

  protected $useTimestamps = false;

  public function modelList($where = null)
  {
    $builder = $this->db->table('mass_trapping_parcel_list');
    if($where){
      $builder->where($where);
    }
    $query = $builder->get();
    return $query->getResult('Fmis\Entities\MassTrappingParcelEntity');
  }
}