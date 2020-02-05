<?php

namespace App\Tests\Service;

use App\Entity\Booking;
use App\Service\ServiceBooking;
use Doctrine\ORM\EntityManagerInterface;
use PHPUnit\Framework\TestCase;
use App\Entity\Ticket;

class ServiceBookingTest extends TestCase 
{
   public function testCalulPrixDuTicketPourMoinsDe3A()
    {
        
        $ticket = new Ticket();
        //$booking = new Booking();
        $ticket->setBirthdate(new \DateTime("2019-02-21"));
        $ticket->setReducedprice(false);
        $ticket->setTicketprice(false);
        $serviceBooking = new ServiceBooking;
        $result = $serviceBooking->CalculPriceTicket($ticket);
        $this->assertEquals(0, $result); // prix du ticket attendu = 0
    }

    public function testCalulPrixDuTicketPour4Aa11ADemiejournée()
    {
        $ticket = new Ticket();
        $ticket->setBirthdate(new \DateTime("2015-05-01"));
        $ticket->setReducedprice(false);
        $ticket->setTicketprice(false);
        $serviceBooking = new ServiceBooking;
        $result = $serviceBooking->CalculPriceTicket($ticket);
        $this->assertEquals(4, $result); // prix du ticket attendu = 4
    }

    public function testCalulPrixDuTicketPour12Aa59ATarifréduit( )
    {
        $ticket = new Ticket();
        $ticket->setBirthdate(new \DateTime("1980-05-01"));
        $ticket->setReducedprice(true);
        $ticket->setTicketprice(false);
        $servicebooking = new ServiceBooking();
        $result = $servicebooking->CalculPriceTicket($ticket);
        $this->assertEquals(8, $result); // prix du ticket attendu = 10
    }

    public function testCalulPrixDuTicketPour12Aa59A( )
    {
        $ticket = new Ticket();
        $ticket->setBirthdate(new \DateTime("1980-05-01"));
        $ticket->setReducedprice(false);
        $ticket->setTicketprice(false);
        $servicebooking = new ServiceBooking();
        $result = $servicebooking->CalculPriceTicket($ticket);
        $this->assertEquals(16, $result); // prix du ticket attendu = 16
    }

    public function testCalulPrixDuTicketPlus60( )
    {
        $ticket = new Ticket();
        $ticket->setBirthdate(new \DateTime("1940-05-01"));
        $ticket->setReducedprice(true);
        $ticket->setTicketprice(true);
        $servicebooking = new ServiceBooking();
        $result = $servicebooking->CalculPriceTicket($ticket);
        $this->assertEquals(10, $result); // prix du ticket attendu = 6
    }
}