<?php
namespace Drupal\fpntc_train\EventSubscriber;

use Drupal\Core\Routing\RouteMatchInterface;
use Drupal\fpntc_train\Service\FpntcUpdateServiceInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;
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
  /**
   * The route match object for the current page.
   *
   * @var \Drupal\Core\Routing\RouteMatchInterface
   */
  protected $routeMatch;

  public function __construct(RequestStack $request_stack, FpntcUpdateServiceInterface $fpntcUpdateService, RouteMatchInterface $route_match){
    $this->requestStack = $request_stack;
    $this->fpntcUpdateService = $fpntcUpdateService;
    $this->routeMatch = $route_match;
  }

  /**
   * {@inheritdoc}
   */
  public static function getSubscribedEvents()
  {
    $events[KernelEvents::RESPONSE][] = ['resource'];
    return $events;
  }
  public function resource(FilterResponseEvent $event){
    $route_name = $this->routeMatch->getRouteName();
    if (explode('/', $route_name)[0] == 'system.404'){
      return;
    }

    $request = $this->requestStack->getCurrentRequest();
    $basePath = $request->getPathInfo();

    if (explode('/',$basePath)[1] == 'resources'){
      $email = $request->query->get('email');
      $trainUserId = $request->query->get('UserID');
      $this->fpntcUpdateService->updateUser($trainUserId, $email);
    }
  }
}