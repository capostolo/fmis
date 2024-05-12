<?php namespace Fmis\Entities;

use CodeIgniter\Entity\Entity;
use CodeIgniter\I18n\Time;

class SoilManagementParcelEntity extends Entity
{
  protected function setSoilManagementDate(string $dateString = null)
  {
    if(!$dateString){
      $this->attributes['soil_management_date'] = null;
      return $this;
    }
    $thedate = Time::createFromFormat('d/m/Y', $dateString, 'Europe/Athens');
    $this->attributes['soil_management_date'] = $thedate->toDateString();
    return $this;
  }

  protected function getSoilManagementDate()
  {
    if($this->attributes['soil_management_date'] === null){
      return null;
    }
    return $this->mutateDate($this->attributes['soil_management_date']);
  }
  
  protected function getDirDate()
  {
    if($this->attributes['dir_date'] === null){
      return null;
    }
    return $this->mutateDate($this->attributes['dir_date']);
  }


  protected function getApplicationDate()
  {
    if($this->attributes['application_date'] === null){
      return null;
    }
    return $this->mutateDate($this->attributes['application_date']);
  }

}