<?php

namespace App\Validator\Constraints;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

/**
 * @Annotation
 */
class ThousandTicketsValidator extends ConstraintValidator
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager){
        $this->entityManager = $entityManager;
    }
    public function validate($value, Constraint $constraint)
    {     
       // $this->entityManager->getRepository(Booking::class)->find....   
        // $repository = $this->getDoctrine()->getRepository(Booking::class);
        // $datebooking = $repository->findBy(
        //     ['date' => $booking->getVisitdate(),
        //      'id' => $id]);
        //      var_dump($datebooking);
        // $repository2 = $this->getDoctrine()->getRepository(Booking::class);

        if($value) {
            $this->context->addViolation($constraint->message);
        }
    }
}
?>