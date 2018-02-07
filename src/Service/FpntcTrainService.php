<?php

namespace Drupal\fpntc_train\Service;

use Drupal\Core\Config\ConfigFactory;

class FpntcTrainService implements FpntcTrainServiceInterface
{
    private $fpntcTrainLoginService;
    private $cookieService;
    private $baseUrl;

    public function __construct(FpntcTrainLoginServiceInterface $fpntcTrainLoginService,
                                FpntcTrainCookieServiceInterface $cookieService, ConfigFactory $config_factory)
    {
        $this->fpntcTrainLoginService = $fpntcTrainLoginService;
        $this->cookieService = $cookieService;
        $this->baseUrl = $config_factory->getEditable('fpntc_train.settings')->get('fpntc_train.link');
    }
    public function updateUserRegistration($userId, $courseId, $courseGradePoints, $courseGradePercentage, $completionDate){
        $status = $this->fpntcTrainLoginService->login($this->cookieService->getCookie());

        if ($status['0']){
            $url = $this->baseUrl.'UpdateRegistration';
            $response = $this->fpntcTrainLoginService->getHttpClient()->request('POST', $url, [
                'form_params' => [
                    'userID' => $userId,
                    'courseID' => $courseId,
                    'courseGradePoints' => $courseGradePoints,
                    'courseGradePercentage' => $courseGradePercentage,
                    'completionDate' => $completionDate
                ],
                'cookies' => $this->cookieService->getCookie()
            ]);
        }
        $mc = json_encode(simplexml_load_string($response->getBody()->getContents()));
        //$loginStatus = $this->fpntcTrainLoginService->loginStatus($this->cookieService->getCookie());
        drupal_set_message($mc .'login status');
    }
}