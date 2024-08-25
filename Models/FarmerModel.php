<?php namespace Fmis\Models;

use CodeIgniter\Model;

class FarmerModel extends Model
{
  protected $DBGroup = 'fmis';
  protected $table      = 'farmer';
  protected $primaryKey = 'id';

  protected $useAutoIncrement = true;

  protected $returnType     = 'Fmis\Entities\FarmerEntity';
  protected $useSoftDeletes = false;

  protected $allowedFields = [];

  protected $useTimestamps = false;

  public function getPendingDir($where = null){
    $builder = $this->db->table('farm_dir_pending');
    if($where){
      $builder->where($where);
    }
    $query = $builder->get();
    return $query->getResult('Fmis\Entities\FarmerEntity');
  }
}