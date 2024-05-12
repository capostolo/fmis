<?php namespace Fmis\Models;

use CodeIgniter\Model;

class PruningModel extends Model
{
  protected $DBGroup = 'fmis';
  protected $table      = 'pruning';
  protected $primaryKey = 'id';

  protected $useAutoIncrement = true;

  protected $returnType     = 'Fmis\Entities\PruningEntity';
  protected $useSoftDeletes = false;

  protected $allowedFields = ['farmer_id', 
                              'dir_date', 
                              'pruning_type_id', 
                              'pruning_equipment_id', 
                              'farming_stage_id', 
                            ];

  protected $useTimestamps = false;

  public function modelList($where = null)
  {
    $builder = $this->db->table('pruning_list');
    if($where){
      $builder->where($where);
    }
    $query = $builder->get();
    return $query->getResult('Fmis\Entities\PruningEntity');
  }

  /*
  public function parcelList($where = null)
  {
    $builder = $this->db->table('pruning_parcel_list');
    if($where){
      $builder->where($where);
    }
    $query = $builder->get();
    return $query->getResult('Fmis\Entities\PruningEntity');
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
    `t`.`pruning_id` AS `pruning_id`,
    `t`.`id` AS `pruning_parcel_id`,
    `t`.`pruning_date` AS `application_date`,
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
            `pruning_parcel`.`id`,
            `pruning_parcel`.`parcel_id`,
            `pruning_parcel`.`pruning_date`,
            `pruning_parcel`.`pruning_id`,
            `pruning`.`dir_date`
        FROM
            `pruning_parcel`
        JOIN `pruning` ON(
                `pruning_parcel`.`pruning_id` = `pruning`.`id`
            )
        WHERE
            `pruning`.`id` = ".$practice."
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