<?php

namespace Drupal\d8custom\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\d8custom\WeatherManager;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;


/**
 * @Block(
 *   id = "dB_custom_weather_block",
 *   admin_label = @Translation("Weather Block"),
 *   category = @Translation("Custom")
 * )
 */
class WeatherBlock extends BlockBase implements ContainerFactoryPluginInterface {


	public function __construct(array $configuration, $plugin_id, $plugin_definition,WeatherManager $weather_manager)
	{

		parent::__construct($configuration, $plugin_id, $plugin_definition);
		$this->WeatherManager = $weather_manager;

	}

	/**
	 * Builds and returns the renderable array for this block plugin.
	 *
	 * If a block should not be rendered because it has no content, then this
	 * method must also ensure to return no content: it must then only return an
	 * empty array, or an empty array with #cache set (with cacheability metadata
	 * indicating the circumstances for it being empty).
	 *
	 * @return array A renderable array representing the content of the block.
	 *
	 * @see \Drupal\block\BlockViewBuilder
	 */
	public function build() {
		return [
		/*
$city_weather_data = $this->WeatherManager->fetchWeatherData($this->configuration[])
		return[
		'#theme'=> 'weather_info',
		'#temp'=>$city_weather_data['temp'],
		'#pressure'=>$city_weather_data['pressure'],
		'#humidity'=>$city_weather_data['humidity'],
		'#temp_min'=>$city_weather_data['temp_min'],
		'#temp_max'=>$city_weather_data['temp_max'],
		'#attached'=>[
		'library'=>'d8custom/weather-widget'


     		   ];
*/
 	'#markup' => implode('|', $this-> WeatherManager-> fetchWeatherData($this->configuration['city'])),
		        ];

	                         }

	/**
	 *
	 * {@inheritdoc}
	 *
	 */
	public function blockForm($form, FormStateInterface $form_state) {
		return [
				'city' => [
				    '#type' => 'textfield',
				    '#title' => 'city config for this block',
					'#default_value' => $this->configuration['city'],
				]
		];
	}

	/**
	 * {@inheritdoc}
	 */
	public function blockSubmit($form, FormStateInterface $form_state) {
		$this ->setConfigurationValue('city', $form_state->getValue('city'));
	}

	public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition)
	{

       	return new static($configuration, $plugin_id, $plugin_definition,
			$container->get('d8custom.weather.manager'));
	}
}
?>