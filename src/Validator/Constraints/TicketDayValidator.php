<?php

namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class TicketDayValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
        //ici, $value correspondt à $ticketprice
        //on recupère la date d'aujourd'hui et l'heure
        $todayDate = new \DateTime();
        // on ne garde que l'heure
        $time = $todayDate->format('H');
        // on rectifie l'heure au bon fuseau horaire
        $time = $time + 1;

        //on récupère la date de visite-> 
        //je ne suis pas sûre que ça fonctionne et qu'on recupère bien la date dans le formulaire
        $visitdate = $value->getBooking()->getVisitdate();

        //on recupère le champ ticketprice remplis dans le formulaire->
        //même pbl qu'au dessus
        $ticketprice = $value->getTicketprice(); 
        
        if ( $time > 13 
                && $visitdate 
                && $visitdate->getTimestamp() == $todayDate->getTimestamp() 
                && $value->getTicketprice() == true) {
            $this->context->addViolation($constraint->message);
        }
    }
}
?>