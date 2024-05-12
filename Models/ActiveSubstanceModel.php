<?php namespace Fmis\Models;

use CodeIgniter\Model;

class ActiveSubstanceModel extends Model
{
  protected $DBGroup = 'fmis';
  protected $table      = 'active_substance';
  protected $primaryKey = 'id';

  protected $useAutoIncrement = true;

  protected $returnType     = 'Fmis\Entities\ActiveSubstanceEntity';
  protected $useSoftDeletes = false;

  protected $allowedFields = ['description', 
];

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