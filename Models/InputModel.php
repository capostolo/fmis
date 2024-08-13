<?php namespace Fmis\Models;

use CodeIgniter\Model;

class InputModel extends Model
{
  protected $DBGroup = 'fmis';
  protected $table      = 'input_list';


  protected $returnType     = 'Fmis\Entities\InputEntity';
  protected $useSoftDeletes = false;

  protected $allowedFields = [];

  protected $useTimestamps = false;

  /*
  public function modelList($where = null)
  {
    $builder = $this->db->table('farm_inputs_list');
    if($where){
      $builder->where($where);
    }
    $query = $builder->get();
    return $query->getResult('Fmis\Entities\FarmInputsEntity');
  }
  */
}