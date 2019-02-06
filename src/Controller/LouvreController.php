<?php

namespace App\Controller;

use DateTime;
use App\Entity\Ticket;
use App\Entity\Booking;
use App\Form\BookingType;
use App\Service\ServiceBooking;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Translation\TranslatorInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class LouvreController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function home()
    {
        return $this->render('louvre/home.html.twig');
    }
    
    /**
     * @Route("/booking", name="booking")
     */
    public function booking(Request $request, ServiceBooking $serviceBooking, EntityManagerInterface $entitymanager)
    {
        $booking = new Booking(); 
        $ticket = new Ticket(); 

        $booking->addTicket($ticket);
 
        $form = $this->createForm(BookingType::class, $booking);
        
        $form->handleRequest($request);

        if($form->isSubmitted($booking) && $form->isValid($booking)) 
        {   
            $date = $booking->getVisitdate();            
            $r = $entitymanager->getRepository(Booking::class)->countByDay($date);
            
            if($r > 999) {
                $this->addFlash(
                    'danger',
                    $message = "Plus de 1000 tickets ont deja été réservés pour ce jour. Merci de choisir une autre date de visite"
                    );        
                return $this->render('louvre/booking.html.twig', array('formBooking' => $form->createView()));    
            }

            $serviceBooking->create($booking);

            return $this->redirectToRoute('payment');
        }

        return $this->render('louvre/booking.html.twig', array('formBooking' => $form->createView()));    
    } 

    /**
     * @Route("/payment", name="payment")
     */
    public function payment(\Swift_Mailer $mailer)
    // public function payment($argumentbookingprecedent)
    {
        // $argumentbookingprecedent->getTotalPrice(); 

        // if {
        // le paiement est accepté        
        // $message = (new \Swift_Message('Confirmation de réservation'))
        // ->setFrom('réservation@muséedulouvre.fr')
        // ->setTo($argumentbookingprecedent->getEmail())
        // ->setBody(
        //     $this->renderView(
        //         'email.html.twig'
        //     ),
        //     'text/html');

        //     $mailer->send($message);
        //     return $this->render('.../payment.html.twig');
        // }
        
        // else { 
        // le paiement n'est pas passé
        // on reste sur la même page, on envoi un message flash pour dire que ça n'est pas 
        // passé et qu'il faut recommencer la manip
        // $this->addFlash(
        //              'warning',
        //              "le paiement n'a pas été accepté, merci de recommancer"
        //              );  

        return $this->render('louvre/payment.html.twig');
    }

    /**
     * @Route("/infos", name="infos")
     */
    public function infos()
    {
        return $this->render('louvre/infos.html.twig');
    }
}
