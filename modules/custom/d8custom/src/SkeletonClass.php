<?php

namespace Drupal\d8custom;

use Drupal\core\Database\connection;
use Symfony\Component\DependencyInjection\Alias;

class SkeletonClass {
	public function __construct(Connection $connection) {
		$this->database = $connection;
	}
	public function read() {
		return $this->database->select ( 'tb' )->fields ( 'name' )->range ( 0, 1 )->execute ()->fetchField ();
	}
	public function write($name) {
		$this->database->insert ( 'tb' )->fields ( [
				'name'
		], [
				$name
		] )->execute ();
	}
}
?>

