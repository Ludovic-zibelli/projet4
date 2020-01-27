<?php

namespace App\Service;

use Symfony\Bundle\SwiftmailerBundle\SwiftmailerBundle;

class ServiceMailer {
    // le service ne se declenche que si le payement a été a son terme
    // il permet d'envoyer un email à la personne qui a passer commande
    private $mailer;
    private $templating;

    public function __construct(\Swift_Mailer $mailer, \Twig\Environment $templating)
    {
        $this->mailer       = $mailer;
        $this->templating   = $templating;
    }

    public function userConfirmation($email, $number, $date, $price, $repoticket, $id) : bool
   {

       $message = (new \Swift_Message())
           ->setSubject('Le Musée du Louvre')
           ->setFrom('no_repli@louvre.fr')
           ->setTo($email)
           ->setBody(
               $this->templating->render(
                   'louvre/registrations.html.twig', [
                       'date' => $date,
                       'price' => $price,
                       'number' => $number,
                       'tickets' => $repoticket->findBy(['id' => $id])
                   ]
               ),
               'text/html'
           );
       return $this->mailer->send($message);

    }
}
/**public function sendMailConfirmation(Visit $visit)
    {
        $email = $visit->getCustomer()->getEmail();

        $message = (new \Swift_Message())
            ->setContentType('text/html')
            ->setSubject($this->translator->trans('emailservice.subject_validator_order'))
            ->setFrom($this->emailfrom)
            ->setTo($email);
        /*1
        $img = $message->embed(\Swift_Image::fromPath('assets/img/logo-
louvre.jpg'));
        /*2
        $message->setBody($this->templating >render('Emails/registration.html.twig', ['visit' => $visit, 'img' => $img]));

        return $this->mailer->send($message);

    }**/