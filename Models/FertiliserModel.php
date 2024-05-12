<?php namespace Fmis\Models;

use CodeIgniter\Model;

class FertiliserModel extends Model
{
  protected $DBGroup = 'fmis';
  protected $table      = 'fertiliser';
  protected $primaryKey = 'id';

  protected $useAutoIncrement = true;

  protected $returnType     = 'Fmis\Entities\FertiliserEntity';
  protected $useSoftDeletes = false;

  protected $allowedFields = ['fertiliser_description', 
'nutrient_content', 
'mineral_content',
'ecoscheme_id', 
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