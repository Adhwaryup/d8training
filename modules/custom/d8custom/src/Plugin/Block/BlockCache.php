<?php 

namespace Drupal\d8custom\Plugin\Block;
use Drupal\Core\Block\BlockBase;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * @Block(
 *   id = "dB_custom_block_cache",
 *   admin_label = @Translation("Cache Block"),
 *   category = @Translation("Custom")
 * )
 */


class BlockCache extends BlockBase implements ContainerFactoryPluginInterface
{
	public function __construct(array $configuration, $plugin_id, $plugin_definition,Connection $database)
	{
		
		parent::__construct($configuration, $plugin_id, $plugin_definition);
		$this-> database = $database;
		
	}
	
	public function build() {
	$build =[];
	$output ='';
	
	$query = $this->database->select('node_field_data','nfd')
    ->field('nfd',['nid','title'])
    ->range(0,3)
    ->orderBy('nid','DESC')
    ->execute();
	
    $result = $query->fetchAll();
    
    foreach ($results as $result){
    	$output .= '|'.$result->title;
    //	$tags[]= 'node:' . $result->nid;
    }
	
    $build['#markup'] =$output;
    $build['#cache']['#tags'] =$tags;
     return $build;
	}

	public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition)
	{
		
		return new static($configuration, $plugin_id, $plugin_definition,
				$container->get('database'));
	}
}

?>