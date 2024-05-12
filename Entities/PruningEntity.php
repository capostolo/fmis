<?php namespace Fmis\Entities;

use CodeIgniter\Entity\Entity;
use CodeIgniter\I18n\Time;

class PruningEntity extends Entity
{
  protected function setDirDate(string $dateString = null)
  {
    if(!$dateString){
      $this->attributes['dir_date'] = null;
      return $this;
    }
    $thedate = Time::createFromFormat('d/m/Y', $dateString, 'Europe/Athens');
    $this->attributes['dir_date'] = $thedate->toDateString();
    return $this;
  }

  protected function getDirDate()
  {
    if($this->attributes['dir_date'] === null){
      return null;
    }
    return $this->mutateDate($this->attributes['dir_date']);
  }

}