<?php

// https://symfony.com/doc/current/form/unit_testing.html

namespace App\Tests\Form;

use App\Entity\Booking;
use App\Form\BookingForm; 
use Symfony\Component\Form\Test\TypeTestCase;

class BookingFormTest extends TypeTestCase 
{
   public function testSubmitValidData()
   {
      $formData = [
         'test' => 'test',
         'test2' => 'test2',
      ];

      $objectToCompare = new Booking();
      $form = $this->factory->create(BookingForm::class, $objectToCompare);

      $object = new Booking();
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