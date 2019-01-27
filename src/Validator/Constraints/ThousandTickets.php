<?php

namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class ThousandTickets extends Constraint
{
    public $message = 'Trop de visiteurs! Vous ne pouvez plus réserver pour aujourd\'hui, merci de choisir un autre jour';
}
?>