<?php

namespace Drupal\d8custom\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;


/**
 * @Block(
 *   id = "dB_user_email",
 *   admin_label = @Translation("User Email Block"),
 *   category = @Translation("Custom")
 * )
 */ 

class blockPlugin extends BlockBase implements ContainerFactoryPluginInterface
{
	
	private $account;
	
	public function __construct(array $configuration, $plugin_id, $plugin_definition, account $account)
	{
		
		parent::__construct($configuration, $plugin_id, $plugin_definition);
		$this->account = $account;
		
	}
       public function build()
       {
       		return  [
       				'#markup' =>$this-> account -> getEmail(),
                    '#cache'  =>[ $contexts=>['user'],],
                   
         ];

       }
       public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition)
       {
       	
       	return new static($configuration, $plugin_id, $plugin_definition,
       			$container->get('current_user'));
       }


}


?>