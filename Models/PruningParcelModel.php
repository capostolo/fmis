<?php namespace Fmis\Models;

use CodeIgniter\Model;

class PruningParcelModel extends Model
{
  protected $DBGroup = 'fmis';
  protected $table      = 'pruning_parcel';
  protected $primaryKey = 'id';

  protected $useAutoIncrement = true;

  protected $returnType     = 'Fmis\Entities\PruningParcelEntity';
  protected $useSoftDeletes = false;

  protected $allowedFields = ['pruning_id', 
                              'parcel_id', 
                              'pruning_date', 
                              'pruning_type_id', 
                              'pruning_equipment_id', 
                              'farming_stage_id', 
                              'carbon_footprint', 
                            ];

  protected $useTimestamps = false;

  public function modelList($where = null)
  {
    $builder = $this->db->table('pruning_parcel_list');
    if($where){
      $builder->where($where);
    }
    $query = $builder->get();
    return $query->getResult('Fmis\Entities\PruningParcelEntity');
  }
}