<?php namespace Fmis\Models;

use CodeIgniter\Model;

class MassTrappingModel extends Model
{
  protected $DBGroup = 'fmis';
  protected $table      = 'mass_trapping';
  protected $primaryKey = 'id';

  protected $useAutoIncrement = true;

  protected $returnType     = 'Fmis\Entities\MassTrappingEntity';
  protected $useSoftDeletes = false;

  protected $allowedFields = ['farmer_id', 
                              'dir_date', 
                              'trap_id', 
                              'traps_hectare', 
                              'farming_stage_id', 
                            ];

  protected $useTimestamps = false;

  public function modelList($where = null)
  {
    $builder = $this->db->table('mass_trapping_list');
    if($where){
      $builder->where($where);
    }
    $query = $builder->get();
    return $query->getResult('Fmis\Entities\MassTrappingEntity');
  }
/*
  public function parcelList($where = null)
  {
    $builder = $this->db->table('mass_trapping_parcel_list');
    if($where){
      $builder->where($where);
    }
    $query = $builder->get();
    return $query->getResult('Fmis\Entities\MassTrappingEntity');
  }
*/
  
  public function parcelList($farmer, $practice)
  {
    $sql = "SELECT
    `parcel`.`id` AS `parcel_id`,
    `parcel`.`farmer_id` AS `farmer_id`,
    `parcel`.`cultivar_code` AS `cultivar_code`,
    `param_so`.`poiDescription` AS `poiDescription`,
    `parcel`.`cultivation_code` AS `cultivation_code`,
    `param_catso`.`poiCategoryName` AS `poiCategoryName`,
    `parcel`.`code` AS `code`,
    `parcel`.`total_area` AS `total_area`,
    `param_so`.`poiCategory` AS `poiCategory`,
    `t`.`mass_trapping_id` AS `mass_trapping_id`,
    `t`.`id` AS `mass_trapping_parcel_id`,
    `t`.`mass_trapping_date` AS `application_date`,
    `t`.`dir_date` AS `dir_date`
FROM
    (
        (
            (
                `parcel`
            JOIN `param_catso` ON
                (
                    `parcel`.`cultivation_code` = `param_catso`.`poiCategory`
                )
            )
        JOIN `param_so` ON
            (
                `parcel`.`cultivation_code` = `param_so`.`poiCategory` AND `parcel`.`cultivar_code` = `param_so`.`poiKodikos`
            )
        )
    LEFT JOIN(
        SELECT
            `mass_trapping_parcel`.`id`,
            `mass_trapping_parcel`.`parcel_id`,
            `mass_trapping_parcel`.`mass_trapping_date`,
            `mass_trapping_parcel`.`mass_trapping_id`,
            `mass_trapping`.`dir_date`
        FROM
            `mass_trapping_parcel`
        JOIN `mass_trapping` ON(
                `mass_trapping_parcel`.`mass_trapping_id` = `mass_trapping`.`id`
            )
        WHERE
            `mass_trapping`.`id` = ".$practice."
    ) `t`
ON
    (`parcel`.`id` = `t`.`parcel_id`)
    )
WHERE
    `param_catso`.`poiType` = 0 AND `parcel`.`farmer_id` = ".$farmer;
    $query = $this->db->query($sql);      
    return $query->getResult('Fmis\Entities\FertilisationEntity');
  }
  
}