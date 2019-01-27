<?php

namespace App\Controller;

use DateTime;
use App\Entity\Ticket;
use App\Entity\Booking;
use App\Form\BookingType;
use App\Service\ServiceBooking;
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
    public function booking(Request $request, 
    ServiceBooking $serviceBooking)
    {
        $booking = new Booking(); 
        $ticket = new Ticket(); 
        $booking->addTicket($ticket);
 
        $form = $this->createForm(BookingType::class, $booking);
        
        $form->handleRequest($request);
        if($form->isSubmitted($booking) && $form->isValid($booking)) 
        {           
           
            $serviceBooking->create($booking);

            return $this->redirectToRoute('home');

            $this->addFlash(
                'success', 
                "Votre commande a bien été prise en compte"
                );
        }
        return $this->render('louvre/booking.html.twig', array('formBooking' => $form->createView()));    
    } 

    /**
     * @Route("/infos", name="infos")
     */
    public function infos()
    {
        return $this->render('louvre/infos.html.twig');
    }
}
