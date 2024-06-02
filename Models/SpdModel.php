<?php namespace Fmis\Models;

use CodeIgniter\Model;

class SpdModel extends Model
{
  protected $DBGroup = 'fmis';
  protected $table      = 'spd_1';

  protected $returnType     = 'Fmis\Entities\SpdEntity';
  protected $useSoftDeletes = false;

  protected $allowedFields = [];

  protected $useTimestamps = false;

  public function getTable2($where = null)
  {
    $builder = $this->db->table('spd_2');
    if($where){
      $builder->where($where);
    }
    $query = $builder->get();
    return $query->getResult('Fmis\Entities\SpdEntity');
  }

  public function getTable3a($where = null)
  {
    $builder = $this->db->table('spd_3a');
    if($where){
      $builder->where($where);
    }
    $query = $builder->get();
    return $query->getResult('Fmis\Entities\SpdEntity');
  }

  public function getTable3b($where = null)
  {
    $builder = $this->db->table('spd_3b');
    if($where){
      $builder->where($where);
    }
    $query = $builder->get();
    return $query->getResult('Fmis\Entities\SpdEntity');
  }

  public function getTable4($where = null)
  {
    $builder = $this->db->table('spd_4');
    if($where){
      $builder->where($where);
    }
    $query = $builder->get();
    return $query->getResult('Fmis\Entities\SpdEntity');
  }

  public function getTable5($where = null)
  {
    $builder = $this->db->table('spd_5');
    if($where){
      $builder->where($where);
    }
    $query = $builder->get();
    return $query->getResult('Fmis\Entities\SpdEntity');
  }
}