<?php namespace Fmis\Entities;

use CodeIgniter\Entity\Entity;
use CodeIgniter\I18n\Time;


class ParcelSoilEntity extends Entity
{
  protected function setDateAnalysis(string $dateString = null)
  {
    if(!$dateString){
      $this->attributes['date_analysis'] = null;
      return $this;
    }
    $thedate = Time::createFromFormat('d/m/Y', $dateString, 'Europe/Athens');
    $this->attributes['date_analysis'] = $thedate->toDateString();
    return $this;
  }

  protected function getDateAnalysis()
  {
    if($this->attributes['date_analysis'] === null){
      return null;
    }
    return $this->mutateDate($this->attributes['date_analysis']);
  }

}