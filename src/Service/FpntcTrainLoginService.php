<?php
namespace Drupal\fpntc_train\Service;

use Drupal\Core\Config\ConfigFactory;
use GuzzleHttp\Client;

class FpntcTrainLoginService implements FpntcTrainLoginServiceInterface
{
    private $header = [];
    private $username;
    private $password;
    private $isSessionAlive = FALSE;
    private $baseUrl;
    private $httpClient;
    private $cookie;

    public function __construct(ConfigFactory $config_factory) {
        $config = $config_factory->getEditable('fpntc_train.settings');
        $this->username = $config->get('fpntc_train.username');
        $this->password = $config->get('fpntc_train.password');
        $this->baseUrl = $config->get('fpntc_train.link');
        $this->httpClient = new Client();
    }
    public function login($cookie){
        $url = $this->baseUrl.'Login';//?loginName='.$this->username.'&password='.$this->password;
        $response = $this->httpClient->request('POST', $url, [
            'form_params' => [
                'loginName' => $this->username,
                'password' => $this->password
            ],
            'cookies' => $cookie
        ]);

        return json_decode(json_encode(simplexml_load_string($response->getBody()->getContents())), TRUE);
    }
    public function loginStatus($cookie){
        $url = $this->baseUrl.'GetLoginStatus';
        $response = $this->httpClient->request('GET', $url, ['cookies' => $cookie]);
        return simplexml_load_string($response->getBody()->getContents());
    }
    public function logout($cookie){

    }
    public function getHttpClient(){
        return $this->httpClient;
    }
}