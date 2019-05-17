<?php

namespace Drupal\d8custom\Access;

use Drupal\core\routing\Access\AccessResult;
use Drupal\core\Routing\Access\AccessInterface;
use Drupal\core\Session\AccountInterface;
use Drupal\node\Entity\Node;

class D8EntityAccessCheck implements AccessInterface {
	public function access(Node $node, Request $request, AccountInterface $account) {
		return AccessResult::allowedIf ( $node->getOwnerId () == $account->id () );
	}
}

?>
