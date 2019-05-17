<?php

namespace Drupal\d8custom\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\node\Entity\Node;
use Symfony\Component\HttpFoundation\Request;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

class DBCustomController extends ControllerBase {
	public function staticContent() {
		return [
				'#markup' => 'Statically Hellow world '
		];
	}
	public function dynamicContent($abc) {
		return [
				'#markup' => $abc
		];
	}
	public function entityContent(Node $node) {
		return [
				'#markup' => $node->getTitle ()
		];
	}
	public function entityContentMultiple(Node $node1, Node $node2) {
		return [
				'#markup' => $node1->getTitle () . '====' . $node2->getTitle ()
		];
	}
	public function anotherStaticContent() {
		return [
				'#markup' => 'Another statically Hello EveryOne'
		];
	}
	public function entityAccessCheck(Node $node, Request $request, AccountInterface $account) {
		
	return AccessResult::allowedIf($node->getOwnerId() == $account->id());
		
	}
}
?>
