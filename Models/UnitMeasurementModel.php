<?php namespace Fmis\Models;

use CodeIgniter\Model;

class UnitMeasurementModel extends Model
{
  protected $DBGroup = 'fmis';
  protected $table      = 'unit_measurement';
  protected $primaryKey = 'id';

  protected $useAutoIncrement = true;

  protected $returnType     = 'Fmis\Entities\UnitMeasurementEntity';
  protected $useSoftDeletes = false;

  protected $allowedFields = ['unit_measurement_description', 
];

  protected $useTimestamps = false;

  /*
  public function modelList($where = null)
  {
    $builder = $this->db->table('unit_measurement_list');
    if($where){
      $builder->where($where);
    }
    $query = $builder->get();
    return $query->getResult('Fmis\Entities\UnitMeasurementEntity');
  }
  */
}