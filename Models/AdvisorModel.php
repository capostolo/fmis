<?php namespace Fmis\Models;

use CodeIgniter\Model;

class AdvisorModel extends Model
{
  protected $DBGroup = 'fmis';
  protected $table      = 'advisor';
  protected $primaryKey = 'id';

  protected $useAutoIncrement = true;

  protected $returnType     = 'Fmis\Entities\AdvisorEntity';
  protected $useSoftDeletes = false;

  protected $allowedFields = ['parent_id',
							  'advisor_afm',
							  'advisor_firstname',
							  'advisor_lastname',
							  'advisor_geotee',
							  'advisor_employment'
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