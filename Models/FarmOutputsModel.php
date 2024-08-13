<?php namespace Fmis\Models;

use CodeIgniter\Model;

class FarmOutputsModel extends Model
{
  protected $DBGroup = 'fmis';
  protected $table      = 'farm_outputs';
  protected $primaryKey = 'id';

  protected $useAutoIncrement = true;

  protected $returnType     = 'Fmis\Entities\FarmOutputsEntity';
  protected $useSoftDeletes = false;

  protected $allowedFields = ['farmer_id', 
'invoice_num', 
'invoice_date', 
'buyer_id', 
'output_type', 
'output_name', 
'output_quantity', 
'unit_measurement_id', 
];

  protected $useTimestamps = false;

  /*
  public function modelList($where = null)
  {
    $builder = $this->db->table('farm_outputs_list');
    if($where){
      $builder->where($where);
    }
    $query = $builder->get();
    return $query->getResult('Fmis\Entities\FarmOutputsEntity');
  }
  */
}