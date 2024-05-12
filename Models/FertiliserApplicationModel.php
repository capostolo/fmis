<?php namespace Fmis\Models;

use CodeIgniter\Model;

class FertiliserApplicationModel extends Model
{
  protected $DBGroup = 'fmis';
  protected $table      = 'fertiliser_application';
  protected $primaryKey = 'id';

  protected $useAutoIncrement = true;

  protected $returnType     = 'Fmis\Entities\FertiliserApplicationEntity';
  protected $useSoftDeletes = false;

  protected $allowedFields = ['fertiliser_application_description', 
];

  protected $useTimestamps = false;

  /*
  public function modelList($where = null)
  {
    $builder = $this->db->table('fertiliser_application_list');
    if($where){
      $builder->where($where);
    }
    $query = $builder->get();
    return $query->getResult('Fmis\Entities\FertiliserApplicationEntity');
  }
  */
}