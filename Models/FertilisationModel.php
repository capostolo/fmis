<?php namespace Fmis\Models;

use CodeIgniter\Model;

class FertilisationModel extends Model
{
  protected $DBGroup = 'fmis';
  protected $table      = 'fertilisation';
  protected $primaryKey = 'id';

  protected $useAutoIncrement = true;

  protected $returnType     = 'Fmis\Entities\FertilisationEntity';
  protected $useSoftDeletes = false;

  protected $allowedFields = ['farmer_id',
                              'dir_date', 
                              'fertiliser_id', 
                              'quantity', 
                              'unit_measurement_id', 
                              'fertiliser_application_id', 
                              'farming_stage_id', 
                              'fertilise_equipment_id', 
                              'specialised_fertiliser_id', 
                             ];

  protected $useTimestamps = false;

  public function modelList($where = null)
  {
    $builder = $this->db->table('fertilisation_list');
    if($where){
      $builder->where($where);
    }
    $query = $builder->get();
    return $query->getResult('Fmis\Entities\FertilisationEntity');
  }

  /*
  public function parcelList($where = null)
  {
    $builder = $this->db->table('fertilisation_parcel_list');
    if($where){
      $builder->where($where);
    }
    $query = $builder->get();
    return $query->getResult('Fmis\Entities\FertilisationEntity');
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
    `t`.`fertilisation_id` AS `fertilisation_id`,
    `t`.`id` AS `fertilisation_parcel_id`,
    `t`.`fertilisation_date` AS `application_date`,
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
            `fertilisation_parcel`.`id`,
            `fertilisation_parcel`.`parcel_id`,
            `fertilisation_parcel`.`fertilisation_date`,
            `fertilisation_parcel`.`fertilisation_id`,
            `fertilisation`.`dir_date`
        FROM
            `fertilisation_parcel`
        JOIN `fertilisation` ON(
                `fertilisation_parcel`.`fertilisation_id` = `fertilisation`.`id`
            )
        WHERE
            `fertilisation`.`id` = ".$practice."
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