<?php namespace Fmis\Models;

use CodeIgniter\Model;

class PoModel extends Model
{
  protected $DBGroup = 'fmis';
  protected $table      = 'po';
  protected $primaryKey = 'id';

  protected $useAutoIncrement = true;

  protected $returnType     = 'Fmis\Entities\PoEntity';
  protected $useSoftDeletes = false;

  protected $allowedFields = ['po_name', 
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