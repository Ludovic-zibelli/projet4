<?php

namespace App\Tests\Service;

use App\Service\ServiceBooking; 
use PHPUnit\Framework\TestCase;

class ServiceBookingTest extends TestCase 
// est ce que je dois tester toutes les fonctions ou simplement l'update?
{
   public function TestCalculAge(Ticket $ticket)
   {
       $servicebooking = new ServiceBooking;
       $result = $servicebooking->CalculAge();
        // il faut que je fasse passer un birthdate

        $this->assertEquals(xxx , $result);
        //comment je peux savoir avec que ma newDate change tout le temps ?
   }
}