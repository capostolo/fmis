<?php namespace Fmis\Models;

use CodeIgniter\Model;

class IrrigationModel extends Model
{
  protected $DBGroup = 'fmis';
  protected $table      = 'irrigation';
  protected $primaryKey = 'id';

  protected $useAutoIncrement = true;

  protected $returnType     = 'Fmis\Entities\IrrigationEntity';
  protected $useSoftDeletes = false;

  protected $allowedFields = ['farmer_id', 
                              'dir_date', 
                              'water_quantity_description', 
                              'unit_measurement_id', 
                              'suppling_hours', 
                              'farming_stage_id', 
                              'irrigation_equipment_id', 
                            ];

  protected $useTimestamps = false;

  public function modelList($where = null)
  {
    $builder = $this->db->table('irrigation_list');
    if($where){
      $builder->where($where);
    }
    $query = $builder->get();
    return $query->getResult('Fmis\Entities\IrrigationEntity');
  }
/*
  public function parcelList($where = null)
  {
    $builder = $this->db->table('irrigation_parcel_list');
    if($where){
      $builder->where($where);
    }
    $query = $builder->get();
    return $query->getResult('Fmis\Entities\IrrigationEntity');
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
    `t`.`irrigation_id` AS `irrigation_id`,
    `t`.`id` AS `irrigation_parcel_id`,
    `t`.`irrigation_date` AS `application_date`,
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
            `irrigation_parcel`.`id`,
            `irrigation_parcel`.`parcel_id`,
            `irrigation_parcel`.`irrigation_date`,
            `irrigation_parcel`.`irrigation_id`,
            `irrigation`.`dir_date`
        FROM
            `irrigation_parcel`
        JOIN `irrigation` ON(
                `irrigation_parcel`.`irrigation_id` = `irrigation`.`id`
            )
        WHERE
            `irrigation`.`id` = ".$practice."
    ) `t`
ON
    (`parcel`.`id` = `t`.`parcel_id`)
    )
WHERE
    `param_catso`.`poiType` = 0 AND `parcel`.`farmer_id` = ".$farmer;
    $query = $this->db->query($sql);      
    return $query->getResult('Fmis\Entities\IrrigationEntity');
  }
  
}