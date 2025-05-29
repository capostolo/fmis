<?php namespace Fmis\Models;

use CodeIgniter\Model;

class FarmerYearModel extends Model
{
  protected $DBGroup = 'fmis';
  protected $table      = 'farmer_year';
  protected $primaryKey = 'id';

  protected $useAutoIncrement = true;

  protected $returnType     = 'Fmis\Entities\FarmerYearEntity';
  protected $useSoftDeletes = false;

  protected $allowedFields = ['farmer_id', 'iacs_year'];

  protected $useTimestamps = false;

  /*
  public function modelList($where = null)
  {
    $builder = $this->db->table('active_substance_list');
    if($where){
      $builder->where($where);
    }
    $query = $builder->get();
    return $query->getResult('Fmis\Entities\ActiveSubstanceEntity');
  }
  */
}