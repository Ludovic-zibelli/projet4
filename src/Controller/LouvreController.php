<?php

namespace App\Controller;

use DateTime;
use App\Entity\Ticket;
use App\Entity\Booking;
use App\Form\BookingType;
use App\Service\ServiceMailer;
use App\Service\ServiceStripe;
use App\Service\ServiceBooking;
use App\Repository\TicketRepository;
use App\Repository\BookingRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Translation\TranslatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Validator\Validator\ValidatorInterface;


class LouvreController extends Controller
{
    /**
     * @Route("/{_locale}", name="home",defaults={"_locale":"%locale%"}, methods={"GET","POST"})
     */
    public function home()
    {
        return $this->render('index/index.html.twig');
    }

    /**
     * @Route("/{_locale}/booking", name="booking" , defaults={"_locale":"%locale%"}, methods={"GET","POST"})
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
     * @Route("/{_locale}/payment", name="payment", defaults={"_locale":"%locale%"}, methods={"GET","POST"})
     */
    public function payment(BookingRepository $repo)
    {
        //je recupère le prix de la dernière commande dans la variable $p
        $lastbookingprice = $repo->findBy([], ['id' => 'desc'],1,0);
        $price = $lastbookingprice[0]->getTotalprice();

        return $this->render('louvre/payment.html.twig', ['p' => $price]);
    }

    /**
     * @Route("/{_locale}/charge", name="charge", defaults={"_locale":"%locale%"}, methods={"GET","POST"})
     */
    public function charge(BookingRepository $repo, \Swift_Mailer $mailer, TicketRepository $repoticket, 
    ServiceStripe $serviceStripe, ServiceMailer $serviceMailer)
    {
            $lastbooking = $repo->findBy([], ['id' => 'desc'],1,0);
                $price = $lastbooking[0]->getTotalprice(); 
                $number = $lastbooking[0]->getBookingnumber(); 
                $email = $lastbooking[0]->getEmail();   
                $date = $lastbooking[0]->getVisitDate();
                $date = $date->format('d/m/Y'); 
                $id = $lastbooking[0]->getId();
           
            $result = $serviceStripe->payment($price, $number);
        $repoTicket_2 = $repoticket->findBy(['booking' => $id]);
            if ($result == 'success') {
                $email = $serviceMailer->userConfirmation($email, $number, $date, $price, $repoTicket_2, $id);
                return $this->render('louvre/charge.html.twig');             
            }
            else {
                $this->addFlash(
                    'danger',
                    $message = 'Votre paiement n\'a pas fonctionné. Merci de recommencer'
                    );  
                return $this->render('louvre/payment.html.twig', ['p' => $price]);
            }
            
    }

    /**
     * @Route("/{_locale}/infos", name="infos", defaults={"_locale":"%locale%"}, methods={"GET","POST"})
     */
    public function infos()
    {
        return $this->render('louvre/infos.html.twig');
    }
}
