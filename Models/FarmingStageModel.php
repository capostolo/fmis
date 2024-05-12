<?php namespace Fmis\Models;

use CodeIgniter\Model;

class FarmingStageModel extends Model
{
  protected $DBGroup = 'fmis';
  protected $table      = 'farming_stage';
  protected $primaryKey = 'id';

  protected $useAutoIncrement = true;

  protected $returnType     = 'Fmis\Entities\FarmingStageEntity';
  protected $useSoftDeletes = false;

  protected $allowedFields = ['farming_stage_description', 
];

  protected $useTimestamps = false;

  /*
  public function modelList($where = null)
  {
    $builder = $this->db->table('farming_stage_list');
    if($where){
      $builder->where($where);
    }
    $query = $builder->get();
    return $query->getResult('Fmis\Entities\FarmingStageEntity');
  }
  */
}