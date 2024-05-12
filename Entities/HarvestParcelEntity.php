<?php namespace Fmis\Entities;

use CodeIgniter\Entity\Entity;
use CodeIgniter\I18n\Time;

class HarvestParcelEntity extends Entity
{
  protected function setHarvestDate(string $dateString = null)
  {
    if(!$dateString){
      $this->attributes['harvest_date'] = null;
      return $this;
    }
    $thedate = Time::createFromFormat('d/m/Y', $dateString, 'Europe/Athens');
    $this->attributes['harvest_date'] = $thedate->toDateString();
    return $this;
  }

  protected function getHarvestDate()
  {
    if($this->attributes['harvest_date'] === null){
      return null;
    }
    return $this->mutateDate($this->attributes['harvest_date']);
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