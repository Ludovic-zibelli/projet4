<?php

namespace App\Service;



class ServiceStripe {
			
	// private $entityManager;

	// public function __construct(EntityManagerInterface $entityManager){
	// 	$this->entityManager = $entityManager;
	// }

	public function payment($price, $name)
	{
		\Stripe\Stripe::setApiKey("sk_test_5rsvvXwQzTQCwO0TMlvLCujq");

            try {
                $token = $_POST['stripeToken'];
                $charge = \Stripe\Charge::create([
                'amount' => $price*100,
                'currency' => 'eur',
                'description' => $name,
                'source' => $token,
                ]);
            } 
            catch(\Stripe\Error\Card $e) {
                // Since it's a decline, \Stripe\Error\Card will be caught
                $body = $e->getJsonBody();
                $err  = $body['error'];
              
                print('Status is:' . $e->getHttpStatus() . "\n");
                print('Type is:' . $err['type'] . "\n");
                print('Code is:' . $err['code'] . "\n");
                // param is '' in this case
                print('Param is:' . $err['param'] . "\n");
                print('Message is:' . $err['message'] . "\n");
            } 
            catch (\Stripe\Error\RateLimit $e) {
            // Too many requests made to the API too quickly
            } 
            catch (\Stripe\Error\InvalidRequest $e) {
            // Invalid parameters were supplied to Stripe's API
            } 
            catch (\Stripe\Error\Authentication $e) {
            // Authentication with Stripe's API failed
            // (maybe you changed API keys recently)
            } 
            catch (\Stripe\Error\ApiConnection $e) {
            // Network communication with Stripe failed
            } 
            catch (\Stripe\Error\Base $e) {
            // Display a very generic error to the user, and maybe send
            // yourself an email
            } 
            catch (Exception $e) {
            // Something else happened, completely unrelated to Stripe
            }
        }
}	
	
	