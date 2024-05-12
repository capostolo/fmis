<?php namespace Fmis\Entities;

use CodeIgniter\Entity\Entity;
use CodeIgniter\I18n\Time;

class ParcelEntity extends Entity
{
  
  protected function getSimpleDescription()
  {
    if(mb_strpos($this->attributes['poiDescription'], '(')){
      $start = mb_strpos($this->attributes['poiDescription'], '(') - 1;
      $end = mb_strpos($this->attributes['poiDescription'], ')') + 1; 
      return mb_substr($this->attributes['poiDescription'], 0 , $start) . mb_substr($this->attributes['poiDescription'], $end);
    }
    else {
      return $this->attributes['poiDescription'];
    }
    
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
  
  protected function getDateAnalysis()
  {
    if($this->attributes['date_analysis'] === null){
      return null;
    }
    return $this->mutateDate($this->attributes['date_analysis']);
  }
  
}