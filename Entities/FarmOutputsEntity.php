<?php namespace Fmis\Entities;

use CodeIgniter\Entity\Entity;
use CodeIgniter\I18n\Time;

class FarmOutputsEntity extends Entity
{
  protected function setInvoiceDate(string $dateString = null)
  {
    if(!$dateString){
      $this->attributes['invoice_date'] = null;
      return $this;
    }
    $thedate = Time::createFromFormat('d/m/Y', $dateString, 'Europe/Athens');
    $this->attributes['invoice_date'] = $thedate->toDateString();
    return $this;
  }

  protected function getInvoiceDate()
  {
    if($this->attributes['invoice_date'] === null){
      return null;
    }
    return $this->mutateDate($this->attributes['invoice_date']);
  }

}