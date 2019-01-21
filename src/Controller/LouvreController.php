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
    public function booking(Request $request, ObjectManager $manager, ValidatorInterface $validator, ServiceBooking $serviceBooking)
    {
        $booking = new Booking(); 
        $ticket = new Ticket(); 
        $booking->addTicket($ticket);
 
        $form = $this->createForm(BookingType::class, $booking);
        
        $form->handleRequest($request);

        if($form->isSubmitted($booking) && $form->isValid($booking)) 
        {
            $todayDate = new DateTime();
            $time = $todayDate->format('H');
            $time = $time + 1;

            $ticketprice = $booking->getTicketprice(); 

            if ($time > 13 && $ticketprice == true) {
                $this->addFlash(
                    'warning', 
                    "Votre commande n'est pas valide. Vous ne pouvez commander de billet journée, pour aujourd'hui, après 14h. Choississez un billet Demie-journée."
                    );
                //pas de redirection, on reste sur la même page
            }
            else {
                    // je dois récupérer ici le nbr de billets commandé chaque jour mais avec la liaison entre les tables , pfouuu.
                $repository = $this->getDoctrine()->getRepository(Ticket::class);
                $nbrTicket = $repository->findBy(
                        ['date' => $booking->getVisitdate()]);
                            
                // if ($nbrTicket > 999) {
                if {                     
                    $this->addFlash(
                        'warning', 
                        "Il y a déjà plus de 1000 tickets réservés pour ce jour. Vous ne pouvez plus réserver. Choisissez un autre jour !"
                        );
                        //pas de redirection, on reste sur la même page
                    } 
                else {
                    $booking = $serviceBooking->updatePrice($booking);

                    $manager->persist($booking);
                    $manager->flush();
                    return $this->redirectToRoute('home');

                    $this->addFlash(
                        'success', 
                        "Votre commande a bien été prise en compte"
                        );
                }
            }     
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
