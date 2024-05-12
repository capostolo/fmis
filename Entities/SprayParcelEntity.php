<?php namespace Fmis\Entities;

use CodeIgniter\Entity\Entity;
use CodeIgniter\I18n\Time;

class SprayParcelEntity extends Entity
{
  protected function setSprayDate(string $dateString = null)
  {
    if(!$dateString){
      $this->attributes['spray_date'] = null;
      return $this;
    }
    $thedate = Time::createFromFormat('d/m/Y', $dateString, 'Europe/Athens');
    $this->attributes['spray_date'] = $thedate->toDateString();
    return $this;
  }

  protected function getSprayDate()
  {
    if($this->attributes['spray_date'] === null){
      return null;
    }
    return $this->mutateDate($this->attributes['spray_date']);
  }


  protected function getApplicationDate()
  {
    if($this->attributes['application_date'] === null){
      return null;
    }
    return $this->mutateDate($this->attributes['application_date']);
  }

  protected function getDirDate()
  {
    if($this->attributes['dir_date'] === null){
      return null;
    }
    return $this->mutateDate($this->attributes['dir_date']);
  }
}