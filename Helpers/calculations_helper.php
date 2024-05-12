<?php

function calcNutrientBalance($parcel_id)
{
  $result = array();
  $nmin = 0;
  $pmin = 0;
  $kmin = 0;
  $nmax = 0;
  $pmax = 0;
  $kmax = 0;

  $model = new \Fmis\Models\ParcelModel();
  $nutrients = $model->getNutrients(['parcel_id' => $parcel_id]);
  foreach ($nutrients as $n){
    if($n->type == 'min'){
      $nmin = $n->nitrogen * 1.33 * 4;
      $pmin = $n->phosphorus * 1.33 * 4;
      $kmin = $n->potassium * 1.33 * 4;
    }
    else{
      $nmax = $n->nitrogen * 1.33 * 4;
      $pmax = $n->phosphorus * 1.33 * 4;
      $kmax = $n->potassium * 1.33 * 4;
    }
  }
  $result['nitrogen'] = $nmax - $nmin;
  $result['phosphorus'] = $pmax - $pmin;
  $result['potassium'] = $kmax - $kmin;

  return $result;
}
?>