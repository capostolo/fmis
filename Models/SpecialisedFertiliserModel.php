<?php namespace Fmis\Models;

use CodeIgniter\Model;

class SpecialisedFertiliserModel extends Model
{
  protected $DBGroup = 'fmis';
  protected $table      = 'specialised_fertiliser';
  protected $primaryKey = 'id';

  protected $useAutoIncrement = true;

  protected $returnType     = 'Fmis\Entities\SpecialisedFertiliserEntity';
  protected $useSoftDeletes = false;

  protected $allowedFields = ['specialised_fertiliser_description', 
];

  protected $useTimestamps = false;

  /*
  public function modelList($where = null)
  {
    $builder = $this->db->table('specialised_fertiliser_list');
    if($where){
      $builder->where($where);
    }
    $query = $builder->get();
    return $query->getResult('Fmis\Entities\SpecialisedFertiliserEntity');
  }
  */
}