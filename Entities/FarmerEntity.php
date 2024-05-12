<?php namespace Fmis\Entities;

use CodeIgniter\Entity\Entity;
use CodeIgniter\I18n\Time;

class FarmerEntity extends Entity
{
  protected function setFarmerDtebirth(string $dateString = null)
  {
    if(!$dateString){
      $this->attributes['farmer_dtebirth'] = null;
      return $this;
    }
    $thedate = Time::createFromFormat('d/m/Y', $dateString, 'Europe/Athens');
    $this->attributes['farmer_dtebirth'] = $thedate->toDateString();
    return $this;
  }

  protected function getFarmerDtebirth()
  {
    if($this->attributes['farmer_dtebirth'] === null){
      return null;
    }
    return $this->mutateDate($this->attributes['farmer_dtebirth']);
  }

}