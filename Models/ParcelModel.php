<?php namespace Fmis\Models;

use CodeIgniter\Model;

class ParcelModel extends Model
{
  protected $DBGroup = 'fmis';
  protected $table      = 'parcel';
  protected $primaryKey = 'id';

  protected $useAutoIncrement = true;

  protected $returnType     = 'Fmis\Entities\ParcelEntity';
  protected $useSoftDeletes = false;

  protected $allowedFields = ['code', 
                              'total_area', 
                              'co_ownership_percent', 
                              'cultivation_code', 
                              'cultivar_code', 
                              'farmer_id', 
                              'location', 
                              'community_code', 
                              'geom64',
                              'balance_n',
                              'balance_p',
                              'balance_k'
                             ];

  protected $useTimestamps = false;

  public function getYears($where = null){
    $builder = $this->db->table('parcel_years');
    if($where){
      $builder->where($where);
    }
    $query = $builder->get();
    return $query->getResult();
  }

  public function getCropList($where = null){
    $builder = $this->db->table('crop_list');
    if($where){
      $builder->where($where);
    }
    $query = $builder->get();
    return $query->getResult();
  }
  
  public function getShortList($where = null){
    $builder = $this->db->table('crop_list');
    if($where){
      $builder->where($where);
    }
    $query = $builder->get();
    return $query->getResult();
  }

	public function getParcel($where = null){
    $builder = $this->db->table('crop_list');
    if($where){
      $builder->where($where);
    }
    $query = $builder->get();
    return $query->getRow();
  }

  public function getCalendar($where = null){
    $builder = $this->db->table('parcel_calendar');
    if($where){
      $builder->where($where);
    }
    $query = $builder->get();
    return $query->getResult('Fmis\Entities\ParcelEntity');
  }

  public function getCalendarAnalysis($where = null){
    $builder = $this->db->table('parcel_calendar_analysis');
    if($where){
      $builder->where($where);
    }
    $query = $builder->get();
    return $query->getResult('Fmis\Entities\ParcelEntity');
  }

	public function getNutrients($where = null){
    $builder = $this->db->table('parcel_nutrient_balance');
    if($where){
      $builder->where($where);
    }
    $query = $builder->get();
    return $query->getResult('Fmis\Entities\ParcelEntity');
  }

  public function getActives($where = null){
    $builder = $this->db->table('parcel_active_quantity');
    if($where){
      $builder->where($where);
    }
    $query = $builder->get();
    return $query->getResult('Fmis\Entities\ParcelEntity');
  }
  
}