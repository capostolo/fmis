<?php namespace Fmis\Models;

use CodeIgniter\Model;

class ParcelLeafModel extends Model
{
  protected $DBGroup = 'fmis';
  protected $table      = 'parcel_leaf';
  protected $primaryKey = 'id';

  protected $useAutoIncrement = true;

  protected $returnType     = 'Fmis\Entities\ParcelLeafEntity';
  protected $useSoftDeletes = false;

  protected $allowedFields = ['parcel_id',
'date_analysis',  
'nitrogen', 
'phosphorus', 
'potassium', 
'calcium', 
'magnesium', 
'borium', 
'ferrum', 
'zincum', 
'cuprum', 
'manganese', 
];

  protected $useTimestamps = false;

  /*
  public function modelList($where = null)
  {
    $builder = $this->db->table('parcel_leaf_list');
    if($where){
      $builder->where($where);
    }
    $query = $builder->get();
    return $query->getResult('Fmis\Entities\ParcelLeafEntity');
  }
  */
}