<?php namespace Fmis\Entities;

use CodeIgniter\Entity\Entity;
use CodeIgniter\I18n\Time;

class MassTrappingParcelEntity extends Entity
{
  protected function setMassTrappingDate(string $dateString = null)
  {
    if(!$dateString){
      $this->attributes['mass_trapping_date'] = null;
      return $this;
    }
    $thedate = Time::createFromFormat('d/m/Y', $dateString, 'Europe/Athens');
    $this->attributes['mass_trapping_date'] = $thedate->toDateString();
    return $this;
  }

  protected function getMassTrappingDate()
  {
    if($this->attributes['mass_trapping_date'] === null){
      return null;
    }
    return $this->mutateDate($this->attributes['mass_trapping_date']);
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