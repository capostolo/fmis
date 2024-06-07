<?php namespace Fmis\Entities;

use CodeIgniter\Entity\Entity;


class SpdEntity extends Entity
{
  protected function getMinDate()
  {
    if($this->attributes['min_date'] === null){
      return null;
    }
    return $this->mutateDate($this->attributes['min_date']);
  }

  protected function getMaxDate()
  {
    if($this->attributes['max_date'] === null){
      return null;
    }
    return $this->mutateDate($this->attributes['max_date']);
  }
}