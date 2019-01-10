<?php
namespace App\Service;

use App\Entity\Ticket;
use App\Entity\Booking;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class ServiceBooking {
    		
	public function updatePrice($booking) 		// mettre à jour la valeur (le prix) dans la variable $booking déclarée dans le controlleur
		{
			echo $booking->getEmail();
			$tickets = $booking->getTickets();

			foreach($tickets as $ticket) {
				$age = $ticket->getAge();
			}
		}

			/*
				$em = $this->em;
				$tickets = $booking->getTickets();
				
				$totalPrice = 0;				
				foreach($tickets as $ticket)
				{
					$age = $ticket->getAge();
                    // j'ai besoin qu'on m'explique les lignes du dessus
                    
function CalculAge($booking) {
	$datetime1 = new DateTime($booking->getBirthdate());
	$datetime2 = new DateTime();
	$interval = $datetime1->diff($datetime2);
	$interval->format('%y');
	return $interval;
}   
// function PriceTicket () {
// 	$age = CalculAge();
// 	if  ({{$formbooking.tickets.ticketprice = true}}) {
// 		if ($formbooking.tickets.reducedprice = true) {
// 			$priceTicket = 10 
// 		else {
// 			if ($age < 4)
// 				$priceTicket = 0
// 			if ($age > 3 & $age < 12)
// 				$priceTicket = 8
// 			if ($age >59)
// 				$priceTicket = 12
// 			elseif
// 				$priceTicket = 16
// 	if  ($formbooking.tickets.ticketprice = false) {
// 		if ($formbooking.tickets.reducedprice = true) {
// 			$priceTicket =  5
// 		else {
// 			if ($age < 4)
// 				$priceTicket = 0
// 			if ($age > 3 & $age < 12)
// 				$priceTicket = 4
// 			if ($age >59)
// 				$priceTicket = 6
// 			elseif
// 				$priceTicket = 8
// }		
// 					$ticket->setPrice($ticketPrice);
					
// 					$totalPrice = $totalPrice + $ticketPrice;
					
// 					$em->persist($ticket);
// 				}
				
// 				$booking->setTotalPrice($totalPrice);
				
// 				$em->persist($booking);
// 				$em->flush();
				
// 				return $booking;
				
// 		}
	
} 
    }*/
        }