<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Translation\TranslatorInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Booking;
use App\Entity\Ticket;
use App\Form\BookingType;
use App\Service\ServiceBooking;


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
    public function booking(Request $request, ObjectManager $manager, ValidatorInterface $validator, ServiceBooking $booking)
    {
        $booking = new Booking(); 
        $ticket = new Ticket(); 
        $booking->addTicket($ticket);
 
        $form = $this->createForm(BookingType::class, $booking);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) 
        {
                $booking = $serviceBooking->udpatePrice($booking);

            $manager->persist($booking);
            $manager->flush();
            return $this->redirectToRoute('home');
        }            
        return $this->render('louvre/booking.html.twig', array('formBooking' => $form->createView(),));
    }  

    /**
     * @Route("/infos", name="infos")
     */
    public function infos()
    {
        return $this->render('louvre/infos.html.twig');
    }
}
