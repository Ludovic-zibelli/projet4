<?php

namespace App\Tests\Service;

use App\Service\ServiceStripe; 
use PHPUnit\Framework\TestCase;

class ServiceStripeTest extends TestCase 
{
    public function testpaymentTryOK()
    {
        $serviceStripe = new ServiceStripe('18', 'Durand');
        $result = $serviceStripe->payment();
        
        $this->assertEquals(xxx , $result);
    }
}