<?php

namespace App\Tests\Entity;

use App\Entity\Ticket; 
use PHPUnit\Framework\TestCase;

class TicketTest extends TestCase 
{
   public function testOfTicket()
   {
      $testt = new Ticket;
      $bookin = 22;
      $testt->setName('Dupont');
      $testt->setFirstname('Julio');
      $testt->setBirthdate(new \DateTime("1983-05-01"));
      $testt->setCountry('BE');
      $testt->setReducedprice(false);
      $testt->setTicketprice(false);
      $testt->setBooking(null);

      $this->assertEquals('Dupont', $testt->getName());
      $this->assertEquals('Julio', $testt->getFirstname());
      $this->assertEquals(new \DateTime("1983-05-01"), $testt->getBirthdate());
      $this->assertEquals('BE', $testt->getCountry());
      $this->assertFalse(false, $testt->getReducedprice());
      $this->assertFalse(false, $testt->getTicketprice());
      $this->assertEquals(false, $testt->getBooking());
   }
       
}