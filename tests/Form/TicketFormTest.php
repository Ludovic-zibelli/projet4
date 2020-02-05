<?php

namespace App\Tests\Form;

use App\Entity\Ticket;
use App\Form\TicketType;
use Symfony\Component\Form\Test\TypeTestCase;

class TicketFormTest extends TypeTestCase 
{
   public function testSubmitValidData()
   {
      $formData = [
         'name' => null,
         'firstname' => null,
          'country' => 'france',
          'birthdate' => '03-04-1983',
          'reducedprice' => false,
      ];

      $objectToCompare = new Ticket();
      $form = $this->factory->create(TicketType::class, $objectToCompare);

      $object = new Ticket();
      $form->submit($formData);
      $this-> assertTrue($form->isSynchronized());
      $this->assertEquals($object, $objectToCompare);

      $view = $form->createView();
      $children = $view->children;

      foreach (array_keys($formData) as $key) {
         $this->assertArrayHasKey($key, $children);
      }       
   }
       
}