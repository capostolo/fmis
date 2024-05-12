<?php namespace Fmis\Models;

use CodeIgniter\Model;

class CoverCropSpeciesModel extends Model
{
  protected $DBGroup = 'fmis';
  protected $table      = 'cover_crop_species';
  protected $primaryKey = 'id';

  protected $useAutoIncrement = true;

  protected $returnType     = 'Fmis\Entities\CoverCropSpeciesEntity';
  protected $useSoftDeletes = false;

  protected $allowedFields = ['cover_crop_species_description', 
];

  protected $useTimestamps = false;

  /*
  public function modelList($where = null)
  {
    $builder = $this->db->table('cover_crop_species_list');
    if($where){
      $builder->where($where);
    }
    $query = $builder->get();
    return $query->getResult('Fmis\Entities\CoverCropSpeciesEntity');
  }
  */
}