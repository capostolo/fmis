<?php namespace Fmis\Models;

use CodeIgniter\Model;

class ProductActiveModel extends Model
{
  protected $DBGroup = 'fmis';
  protected $table      = 'product_active';
  protected $primaryKey = 'id';

  protected $useAutoIncrement = true;

  protected $returnType     = 'Fmis\Entities\ProtectiveProductEntity';
  protected $useSoftDeletes = false;

  protected $allowedFields = ['protective_product_id', 
                              'active_substance_id',
                              'concentration'
];

  protected $useTimestamps = false;

  public function modelList($where = null)
  {
    $builder = $this->db->table('protective_product_list');
    if($where){
      $builder->where($where);
    }
    $query = $builder->get();
    return $query->getResult('Fmis\Entities\ProtectiveProductEntity');
  }
}