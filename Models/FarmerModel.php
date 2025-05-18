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

  protected $allowedFields = ['farmer_afm', 
  'farmer_firstname', 
  'farmer_lastname', 
  'farmer_fathername', 
  'farmer_mobile', 
  'farmer_email', 
  'farmer_dtebirth', 
  'farmer_location', 
  'farmer_source', 
  'advisor_id', 
  'user_id',
  'farmer_po_id'];

  protected $useTimestamps = true;

  public function getList($where = null){
    $builder = $this->db->table('farmer_list');
    if($where){
      $builder->where($where);
    }
    $query = $builder->get();
    return $query->getResult('Fmis\Entities\FarmerEntity');
  }

  public function getFarmer($where = null){
    $builder = $this->db->table('farmer_list');
    if($where){
      $builder->where($where);
    }
    $query = $builder->get();
    return $query->getRow(0, 'Fmis\Entities\FarmerEntity');
  }

  public function getFarmerWithoutUser($where = null){
    $builder = $this->db->table('farmer_no_user');
    if($where){
      $builder->where($where);
    }
    $query = $builder->get();
    return $query->getResult('Fmis\Entities\FarmerEntity');
  }

  public function getPendingDir($where = null){
    $builder = $this->db->table('farm_dir_pending');
    if($where){
      $builder->where($where);
    }
    $query = $builder->get();
    return $query->getResult('Fmis\Entities\FarmerEntity');
  }
	
}