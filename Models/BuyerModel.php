<?php namespace Fmis\Models;

use CodeIgniter\Model;

class BuyerModel extends Model
{
  protected $DBGroup = 'fmis';
  protected $table      = 'buyer';
  protected $primaryKey = 'id';

  protected $useAutoIncrement = true;

  protected $returnType     = 'Fmis\Entities\BuyerEntity';
  protected $useSoftDeletes = false;

  protected $allowedFields = ['buyer_name', 
'buyer_afm', 
];

  protected $useTimestamps = false;

  /*
  public function modelList($where = null)
  {
    $builder = $this->db->table('buyer_list');
    if($where){
      $builder->where($where);
    }
    $query = $builder->get();
    return $query->getResult('Fmis\Entities\BuyerEntity');
  }
  */
}