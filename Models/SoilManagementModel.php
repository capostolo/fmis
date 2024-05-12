<?php namespace Fmis\Models;

use CodeIgniter\Model;

class SoilManagementModel extends Model
{
  protected $DBGroup = 'fmis';
  protected $table      = 'soil_management';
  protected $primaryKey = 'id';

  protected $useAutoIncrement = true;

  protected $returnType     = 'Fmis\Entities\SoilManagementEntity';
  protected $useSoftDeletes = false;

  protected $allowedFields = ['farmer_id', 
                              'dir_date', 
                              'work_type_id', 
                              'purpose_description', 
                              'biodiversity_zone', 
                              'plant_species_sow_id', 
                              'seed_needed', 
                              'cover_crop_species_id', 
                              'cover_crop_seed', 
                              'farming_stage_id', 
                              'plough_equipment_id', 
                            ];

  protected $useTimestamps = false;

  public function modelList($where = null)
  {
    $builder = $this->db->table('soil_management_list');
    if($where){
      $builder->where($where);
    }
    $query = $builder->get();
    return $query->getResult('Fmis\Entities\SoilManagementEntity');
  }

  /*
  public function parcelList($where = null)
  {
    $builder = $this->db->table('soil_management_parcel_list');
    if($where){
      $builder->where($where);
    }
    $query = $builder->get();
    return $query->getResult('Fmis\Entities\SoilManagementEntity');
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
    `t`.`soil_management_id` AS `soil_management_id`,
    `t`.`id` AS `soil_management_parcel_id`,
    `t`.`soil_management_date` AS `application_date`,
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
            `soil_management_parcel`.`id`,
            `soil_management_parcel`.`parcel_id`,
            `soil_management_parcel`.`soil_management_date`,
            `soil_management_parcel`.`soil_management_id`,
            `soil_management`.`dir_date`
        FROM
            `soil_management_parcel`
        JOIN `soil_management` ON(
                `soil_management_parcel`.`soil_management_id` = `soil_management`.`id`
            )
        WHERE
            `soil_management`.`id` = ".$practice."
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