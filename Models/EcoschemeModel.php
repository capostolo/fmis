<?php namespace Fmis\Models;

use CodeIgniter\Model;

class EcoschemeModel extends Model
{
  protected $DBGroup = 'fmis';
  protected $table      = 'ecoschemes';
  protected $primaryKey = 'id';

  protected $useAutoIncrement = true;

  protected $returnType     = 'Fmis\Entities\EcoschemeEntity';
  protected $useSoftDeletes = false;

  protected $allowedFields = ['code', 
'name', 
];

  protected $useTimestamps = false;

  /*
  public function modelList($where = null)
  {
    $builder = $this->db->table('fertiliser_list');
    if($where){
      $builder->where($where);
    }
    $query = $builder->get();
    return $query->getResult('Fmis\Entities\FertiliserEntity');
  }
  */
}