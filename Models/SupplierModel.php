<?php namespace Fmis\Models;

use CodeIgniter\Model;

class SupplierModel extends Model
{
  protected $DBGroup = 'fmis';
  protected $table      = 'supplier';
  protected $primaryKey = 'id';

  protected $useAutoIncrement = true;

  protected $returnType     = 'Fmis\Entities\SupplierEntity';
  protected $useSoftDeletes = false;

  protected $allowedFields = ['supplier_name', 
'supplier_afm', 
];

  protected $useTimestamps = false;

  /*
  public function modelList($where = null)
  {
    $builder = $this->db->table('supplier_list');
    if($where){
      $builder->where($where);
    }
    $query = $builder->get();
    return $query->getResult('Fmis\Entities\SupplierEntity');
  }
  */
}