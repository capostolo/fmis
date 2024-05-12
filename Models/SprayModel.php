<?php namespace Fmis\Models;

use CodeIgniter\Model;

class SprayModel extends Model
{
  protected $DBGroup = 'fmis';
  protected $table      = 'spray';
  protected $primaryKey = 'id';

  protected $useAutoIncrement = true;

  protected $returnType     = 'Fmis\Entities\SprayEntity';
  protected $useSoftDeletes = false;

  protected $allowedFields = ['farmer_id', 
                              'dir_date', 
                              'protective_product_id', 
                              'dose', 
                              'unit_measurement_id', 
                              'target', 
                              'conditions', 
                              'days_before_harvest', 
                              'farming_stage_id', 
                              'spray_equipment_id', 
                            ];

  protected $useTimestamps = false;

  public function modelList($where = null)
  {
    $builder = $this->db->table('spray_list');
    if($where){
      $builder->where($where);
    }
    $query = $builder->get();
    return $query->getResult('Fmis\Entities\SprayEntity');
  }

  /*
  public function parcelList($where = null)
  {
    $builder = $this->db->table('spray_parcel_list');
    if($where){
      $builder->where($where);
    }
    $query = $builder->get();
    return $query->getResult('Fmis\Entities\SprayEntity');
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
    `t`.`spray_id` AS `spray_id`,
    `t`.`id` AS `spray_parcel_id`,
    `t`.`spray_date` AS `application_date`,
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
            `spray_parcel`.`id`,
            `spray_parcel`.`parcel_id`,
            `spray_parcel`.`spray_date`,
            `spray_parcel`.`spray_id`,
            `spray`.`dir_date`
        FROM
            `spray_parcel`
        JOIN `spray` ON(
                `spray_parcel`.`spray_id` = `spray`.`id`
            )
        WHERE
            `spray`.`id` = ".$practice."
    ) `t`
ON
    (`parcel`.`id` = `t`.`parcel_id`)
    )
WHERE
    `param_catso`.`poiType` = 0 AND `parcel`.`farmer_id` = ".$farmer;
    $query = $this->db->query($sql);      
    return $query->getResult('Fmis\Entities\HarvestingEntity');
  }
  
}