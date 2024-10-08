<?php namespace Fmis\Models;

use CodeIgniter\Model;

class ParcelSchemeModel extends Model
{
  protected $DBGroup = 'fmis';
  protected $table      = 'parcel_scheme';
  protected $primaryKey = 'id';

  protected $useAutoIncrement = true;

  protected $returnType     = 'Fmis\Entities\ParcelEntity';
  protected $useSoftDeletes = false;

  protected $allowedFields = ['parcel_id', 
                              'ecoscheme_subsidy_code', 
                              'remarks'
                             ];

  protected $useTimestamps = false;

}