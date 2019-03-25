<?php

namespace App\Tests\Form;

use App\Entity\Ticket;
use App\Form\TicketForm; 
use Symfony\Component\Form\Test\TypeTestCase;

class TicketFormTest extends TypeTestCase 
{
   public function testSubmitValidData()
   {
      $formData = [
         'test' => 'test',
         'test2' => 'test2',
      ];

      $objectToCompare = new Ticket();
      $form = $this->factory->create(TicketForm::class, $objectToCompare);

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