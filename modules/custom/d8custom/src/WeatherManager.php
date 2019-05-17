<?php

namespace Drupal\d8custom;

use Drupal\Core\Config\ConfigFactory;
use GuzzleHttp\Client;
use Drupal\Component\Serialization\Json;


class WeatherManager
{
	private $config_factory;


	private $client;

public function __construct(Client $client, ConfigFactory $config_factory)

 {

  $this->Client = $client ;

  $this->ConfigFactory = $config_factory ;


 }

 public function fetchWeatherData($city)
 {

  $app_id = $this->ConfigFactory -> get('d8custom.weather.manager') ->get('app_id');
  $url_string = "http://localhost/drupal-8.7.1/".$city.".json?app_id =".$app_id;

  #return $url_string;


	try{
		$res = $this->Client->request('GET', 'http://localhost/drupal-8.7.1/mumbai.json');
		
		$res->getStatusCode();
		$body = $res->getBody();
		$data = Json::decode($body);
		return $data['main'];
	}
  	catch (Exception $e) {
  		
  	}

  /*
  	echo $res->getHeader('content-type')[0];
  	// 'application/json; charset=utf8'
  	echo $res->getBody();
  	// {"type":"User"...'*/

    //$res = $this->Client->request('GET', 'http://localhost/drupal-8.7.1/mumbai.json');
   // $res->getStatusCode();
  // $body = $res->getBody();
 // $data = Json::decode($body);
// return $data['main'];


 }

}
?>
