<?php
namespace Drupal\fpntc_train\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\fpntc_train\Service\FpntcTrainServiceInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class FpntcTrainController extends ControllerBase
{
    protected $fpntcTrainService;

    public function __construct(FpntcTrainServiceInterface $fpntcTrainService)
    {
        $this->fpntcTrainService = $fpntcTrainService;
    }

    public static function create(ContainerInterface $container){
        return new static(
            $container->get('fpntc_train.service')
        );
    }
    public function demo(){
        /*$this->fpntcTrainService->updateUserRegistration(****, 1069764, 0,
            0, '02/07/2018');*/
        return array(
            '#theme' => 'fpntc_train',
            '#markup' => t('Testing update of train'),
        );
    }
}