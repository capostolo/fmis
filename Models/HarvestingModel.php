<?php namespace Fmis\Models;

use CodeIgniter\Model;

class HarvestingModel extends Model
{
  protected $DBGroup = 'fmis';
  protected $table      = 'harvesting';
  protected $primaryKey = 'id';

  protected $useAutoIncrement = true;

  protected $returnType     = 'Fmis\Entities\HarvestingEntity';
  protected $useSoftDeletes = false;

  protected $allowedFields = ['farmer_id', 
                              'dir_date', 
                              'harvest_equipment_id', 
                              'stage_of_ripening', 
                            ];

  protected $useTimestamps = false;

  public function modelList($where = null)
  {
    $builder = $this->db->table('harvesting_list');
    if($where){
      $builder->where($where);
    }
    $query = $builder->get();
    return $query->getResult('Fmis\Entities\HarvestingEntity');
  }
/*
  public function parcelList($where = null)
  {
    $builder = $this->db->table('harvest_parcel_list');
    if($where){
      $builder->where($where);
    }
    $query = $builder->get();
    return $query->getResult('Fmis\Entities\HarvestingEntity');
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
    `t`.`harvesting_id` AS `harvesting_id`,
    `t`.`id` AS `harvest_parcel_id`,
    `t`.`harvest_date` AS `application_date`,
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
            `harvest_parcel`.`id`,
            `harvest_parcel`.`parcel_id`,
            `harvest_parcel`.`harvest_date`,
            `harvest_parcel`.`harvesting_id`,
            `harvesting`.`dir_date`
        FROM
            `harvest_parcel`
        JOIN `harvesting` ON(
                `harvest_parcel`.`harvesting_id` = `harvesting`.`id`
            )
        WHERE
            `harvesting`.`id` = ".$practice."
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