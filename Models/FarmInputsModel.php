<?php namespace Fmis\Models;

use CodeIgniter\Model;

class FarmInputsModel extends Model
{
  protected $DBGroup = 'fmis';
  protected $table      = 'farm_inputs';
  protected $primaryKey = 'id';

  protected $useAutoIncrement = true;

  protected $returnType     = 'Fmis\Entities\FarmInputsEntity';
  protected $useSoftDeletes = false;

  protected $allowedFields = ['farmer_id', 
'invoice_num', 
'invoice_date', 
'supplier_id', 
'input_type', 
'input_id', 
'packages', 
'unit_quantity', 
'unit_measurement_id', 
];

  protected $useTimestamps = false;

 
  public function listFertilisers($where = null)
  {
    $builder = $this->db->table('farm_inputs_fertilisers');
    if($where){
      $builder->where($where);
    }
    $query = $builder->get();
    return $query->getResult('Fmis\Entities\FarmInputsEntity');
  }
 
  public function listPpp($where = null)
  {
    $builder = $this->db->table('farm_inputs_ppp');
    if($where){
      $builder->where($where);
    }
    $query = $builder->get();
    return $query->getResult('Fmis\Entities\FarmInputsEntity');
  }
}