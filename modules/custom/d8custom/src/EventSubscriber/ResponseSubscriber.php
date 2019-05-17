<?php
namespace Drupal\d8custom\EventSubscriber;

use Symfony\Component\HttpKernel\Event\FilterResponseEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\KernelEvents;

class ResponseSubscriber implements EventSubscriberInterface{

public static function getSubscribedEvents() {
 return [

 [ kernelEvents::RESPONSE => 'onResponse' ]
  ];

}
  public function onResponse(FilterResponseEvent $event) {
   $response = $event->getReponse();
   $response->header->add(['hello'=>'world']);




  }


}


?>