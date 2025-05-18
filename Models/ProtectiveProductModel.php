<?php namespace Fmis\Models;

use CodeIgniter\Model;

class ProtectiveProductModel extends Model
{
  protected $DBGroup = 'fmis';
  protected $table      = 'protective_product';
  protected $primaryKey = 'id';

  protected $useAutoIncrement = true;

  protected $returnType     = 'Fmis\Entities\ProtectiveProductEntity';
  protected $useSoftDeletes = false;

  protected $allowedFields = ['protective_product_description'
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

  public function getPpList($where = null)
  {
    $builder = $this->db->table('pp_list');
    if($where){
      $builder->where($where);
    }
    $query = $builder->get();
    return $query->getResult('Fmis\Entities\ProtectiveProductEntity');
  }

}