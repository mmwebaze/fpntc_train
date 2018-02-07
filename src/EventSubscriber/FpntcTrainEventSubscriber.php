<?php
namespace Drupal\fpntc_train\EventSubscriber;

use Drupal\fpntc_train\Service\FpntcUpdateServiceInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\HttpFoundation\RequestStack;

class FpntcTrainEventSubscriber implements EventSubscriberInterface {

  /**
   * The request stack.
   *
   * @var \Symfony\Component\HttpFoundation\RequestStack
   */
  protected $requestStack;
  /**
   * The request stack.
   *
   * @var Drupal\fpntc_train\Service\FpntcUpdateService
   */
  protected $fpntcUpdateService;

  public function __construct(RequestStack $request_stack, FpntcUpdateServiceInterface $fpntcUpdateService){
    $this->requestStack = $request_stack;
    $this->fpntcUpdateService = $fpntcUpdateService;
  }

  /**
   * {@inheritdoc}
   */
  public static function getSubscribedEvents()
  {
    $events[KernelEvents::REQUEST][] = ['resource'];
    return $events;
  }
  public function resource(GetResponseEvent $event){
    $request = $this->requestStack->getCurrentRequest();
    $basePath = $request->getPathInfo();

    if (explode('/',$basePath)[1] == 'resources'){
      $email = $request->query->get('email');
      $trainUserId = $request->query->get('UserID');
      $this->fpntcUpdateService->updateUser($trainUserId, $email);

      //$requestUrl = $request->server->get('REQUEST_URI');
      //print_r($requestUrl);die();
    }


  }
}