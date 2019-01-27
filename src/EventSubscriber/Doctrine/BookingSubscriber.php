<?php
namespace App\EventSubscriber\Doctrine;

use Doctrine\Common\EventSubscriber;
use Doctrine\Common\Persistence\Event\LifecycleEventArgs;
use App\Entity\Booking;
use Doctrine\ORM\Events;
use App\Utils\Strings;

class BookingSubscriber implements EventSubscriber{
    
    /**
     * 
     * @var Strings
     */
    private $strings;

    public function __construct(Strings $strings){
        $this->strings = $strings;
    }

    public function getSubscribedEvents()
    {
        return [
            Events::prePersist,
        ];
    }

    public function prePersist(LifecycleEventArgs $args)
    {
        $object =  $args->getObject();
        if(!$object instanceof Booking){
            return;
        }
        
        $object->setBookingnumber($this->strings->getRandomString());
    }
}