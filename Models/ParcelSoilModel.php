<?php namespace Fmis\Models;

use CodeIgniter\Model;

class ParcelSoilModel extends Model
{
  protected $DBGroup = 'fmis';
  protected $table      = 'parcel_soil';
  protected $primaryKey = 'id';

  protected $useAutoIncrement = true;

  protected $returnType     = 'Fmis\Entities\ParcelSoilEntity';
  protected $useSoftDeletes = false;

  protected $allowedFields = ['parcel_id',
'date_analysis',   
'sand', 
'clay', 
'loam', 
'nitrogen', 
'phosphorus', 
'potassium', 
'calcium', 
'magnesium', 
'borium', 
'pH', 
'organic_compound', 
];

  protected $useTimestamps = false;

  /*
  public function modelList($where = null)
  {
    $builder = $this->db->table('parcel_soil_list');
    if($where){
      $builder->where($where);
    }
    $query = $builder->get();
    return $query->getResult('Fmis\Entities\ParcelSoilEntity');
  }
  */
}