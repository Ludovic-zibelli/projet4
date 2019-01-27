<?php

namespace App\Service;

use App\Entity\Booking;
use App\Repository\BookingRepository;

class NbrVisitService {

    private $repositary;

    public function __construct(BookingRepository $repository) {
        $this->$repository = $repository;
    }

    public function VisitByDate(Booking $booking)
	{
	    // on recupère les bookings de la même date que celui de notre futur visiteur
        $VisitByDate = $this->repository->findBy(
            ['date' => $booking->getVisitdate()
            ]);
        // ensuite, il faudrait pouvoir faire le total des tickets contenu dans chacune
        //des collections de tickets de chaque booking

        //au final de cette fonction on doit obtenir un nombre, qui correspondt au nombre de tickets
        //deja commandé pour le jour en question
	}
}

?>