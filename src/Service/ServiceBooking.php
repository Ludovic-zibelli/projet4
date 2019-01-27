<?php

namespace App\Service;

use DateTime;
use DateInterval;
use App\Entity\Ticket;
use App\Entity\Booking;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints\Date;
use Symfony\Component\DependencyInjection\ContainerBuilder;


class ServiceBooking {
			
	private $entityManager;

	public function __construct(EntityManagerInterface $entityManager){
		$this->entityManager = $entityManager;
	}

	public function create(Booking $booking){
		$this->updatePrice($booking);
		$this->persist($booking);
		$this->flush();
	}

	public function CalculAge(Ticket $ticket)
	// on recupère les dates et on calcule l'âge du visiteur
	{
		$datetime1 = $ticket->getBirthdate();
		$datetime2 = new DateTime();
		$age = $datetime1->diff($datetime2);
		return $age->format('y');
	}

	public function CalculPriceTicket(Ticket $ticket)
	// on récupère l'age du visiteur et on calcule le prix de son billet
	{
		$age = $this->CalculAge($ticket);
		$ticketPrice = $ticket->getTicketprice();
		$reducedprice = $ticket->getReducedprice();
		
				if ($age < 4) {	
					$priceTicket = 0;
				}					
				elseif ($age > 3 & $age < 12) {
					$priceTicket = 8;
				}					
				elseif ($age > 59) {
					$priceTicket = 12;
				}			
				else if ($reducedprice == true) {
					$priceTicket = 8;
				}			
			    else {
					$priceTicket = 16;
				}
				if ($ticketPrice == false) $priceTicket = $priceTicket / 2;
		
		return $priceTicket;
		
	}
	public function updatePrice(Booking $booking): Booking 		
	// On récupère le prix de chaque billet et on les ajoute pour avoir le prix de la commande		
	{
		$tickets = $booking->getTickets();
		$total = 0;

		foreach($tickets as $ticket)
		{
			$oneprice = $this->CalculpriceTicket($ticket);
			// $ticket->setPrice($oneprice);
			// ajouter le prix de chaque ticket il faut persister et flush les tickets
			$total = $total + $oneprice;
		}

		$booking->setTotalPrice($total);
		// persister et flush le booking (contruct + entity manager)
		return $booking;
	}
}	
	
	