<?php
namespace App\Service;

use App\Entity\Ticket;
use App\Entity\Booking;
use Symfony\Component\Validator\Constraints\Date;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class ServiceBooking {
    		
	private function CalculAge(Booking $booking)
	// on recupère les dates et on calcule l'âge du visiteur
	{
		$datetime1 = new DateTime($booking->getBirthdate());
		$datetime2 = new DateTime();
			// if($datetime1 && $datetime2 && $datetime1 > $datetime2 ) {
		$age = $datetime1->diff($datetime2);
		$age->format('%y');
		return $age;
			// }
			// else
	}

	private function CalculPriceTicket(Booking $booking)
	// on récupère l'age du visiteur et on calcule le prix de son billet
	{
		$age = CalculAge();
		$ticketprice = $booking->getTicketprice();
		$reducedprice = $booking->getReducedprice();
		if  ($ticketprice == true ) {
			if ($reducedprice == true) {
				if ($age < 4) {
					$priceTicket = 0;
				}					
				elseif ($age > 3 & $age < 12) {
					$priceTicket = 8;
				}					
				elseif ($age > 59) {
					$priceTicket = 12;
				}			
				else {
					$priceTicket = 16;
				}
			}			
			else {
				$priceTicket = 10;
			}
		}
		elseif  ($ticketprice == false) {
			if ($reducedprice == true) {
				if ($age < 4) {
					$priceTicket = 0;
				}					
				elseif ($age > 3 & $age < 12) {
					$priceTicket = 4;
				}					
				elseif ($age > 59) {
					$priceTicket = 6;
				}			
				else {
					$priceTicket = 8;
				}
			}			
			else {
				$priceTicket = 5;
			}
		}
	}
	public function updatePrice($booking) 		
	// On récupère le prix de chaque billet et on les ajoute pour avoir le prix de la commande		
	{
		$priceTicket = CalculAge();
		while ($priceTicket = true ) {
			$totalPrice->setTotalprice();
			$totalPrice = $totalPrice + $ticketPrice;
		}
					
		$booking->setTotalPrice($totalPrice);

			}
		
		}

	
	
	
	
	
// 	{
// 			echo $booking->getEmail();
// 			$tickets = $booking->getTickets();

// 			foreach($tickets as $ticket) {
// 				$age = $ticket->getAge();
// 			}
// 		}

// 			/*
// 				$em = $this->em;
// 				$tickets = $booking->getTickets();
				
// 				$totalPrice = 0;				
// 				foreach($tickets as $ticket)
// 				{
// 					$age = $ticket->getAge();
//                     // j'ai besoin qu'on m'explique les lignes du dessus
                    
// function CalculAge($booking) {
// 	$datetime1 = new DateTime($booking->getBirthdate());
// 	$datetime2 = new DateTime();
// 	$interval = $datetime1->diff($datetime2);
// 	$interval->format('%y');
// 	return $interval;
// }   
// // function PriceTicket () {
// // 	$age = CalculAge();
// // 	if  ({{$formbooking.tickets.ticketprice = true}}) {
// // 		if ($formbooking.tickets.reducedprice = true) {
// // 			$priceTicket = 10 
// // 		else {
// // 			if ($age < 4)
// // 				$priceTicket = 0
// // 			if ($age > 3 & $age < 12)
// // 				$priceTicket = 8
// // 			if ($age >59)
// // 				$priceTicket = 12
// // 			elseif
// // 				$priceTicket = 16
// // 	if  ($formbooking.tickets.ticketprice = false) {
// // 		if ($formbooking.tickets.reducedprice = true) {
// // 			$priceTicket =  5
// // 		else {
// // 			if ($age < 4)
// // 				$priceTicket = 0
// // 			if ($age > 3 & $age < 12)
// // 				$priceTicket = 4
// // 			if ($age >59)
// // 				$priceTicket = 6
// // 			elseif
// // 				$priceTicket = 8
// // }		
// // 					$ticket->setPrice($ticketPrice);
					
// // 					$totalPrice = $totalPrice + $ticketPrice;
					
// // 					$em->persist($ticket);
// // 				}
				
// // 				$booking->setTotalPrice($totalPrice);
				
// // 				$em->persist($booking);
// // 				$em->flush();
				
// // 				return $booking;
				
// // 		}
	
// } 
//     }*/
//         }