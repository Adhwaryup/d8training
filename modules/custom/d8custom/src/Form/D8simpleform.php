<?php

namespace Drupal\d8custom\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\contact\Entity\Message;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\DependencyInjection\ContainerInjectionInterface;

class D8simpleform extends FormBase implements ContainerInjectionInterface {
	private $dbWrapper;
	public function __Construct(Skeleton $dbWrapper) {
		$this->dbWrapper = $dbWrapper;
	}
	/**
	 * Returns a unique string identifying the form.
	 *
	 * The returned ID should be a unique string that can be a valid PHP function
	 * name, since it's used in hook implementation names such as
	 * hook_form_FORM_ID_alter().
	 *
	 * @return string The unique string identifying the form.
	 */
	public function getFormId() {
		return 'D8_simple_form';
	}

	/**
	 * Form constructor.
	 *
	 * @param array $form
	 *        	An associative array containing the structure of the form.
	 * @param \Drupal\Core\Form\FormStateInterface $form_state
	 *        	The current state of the form.
	 *
	 * @return array The form structure.
	 */
	public function buildForm(array $form, FormStateInterface $form_state) {
		$form ['name'] = [
				'#type' => 'textfield',
				'#title' => 'Enter your name',
				'#description' => 'name must have atleast five characters'
			// '#default_value' => $this->dbWrapper->read(),

		];

		$form ['submit'] = [
				'#type' => 'submit',
				'#value' => 'validate First Name'
		];
		return $form;
	}
	public function validateForm(array &$form, FormStateInterface $form_state) {
		if (strlen ( $form_state->getValues ( 'name' ) ) < 5) {
			$form_state->setErrorByName ( 'name', 'name must be atleast 5 character long' );
		}
	}

	/**
	 * Form submission handler.
	 *
	 * @param array $form
	 *        	An associative array containing the structure of the form.
	 * @param \Drupal\Core\Form\FormStateInterface $form_state
	 *        	The current state of the form.
	 */
	public function submitForm(array &$form, FormStateInterface $form_state) {
		$name = $form_state->getValues ( 'name' );
		drupal_set_message ( $name );
	}
	public static function create(ContainerInterface $container) {
		return new static ( $container->get ( 'd8custom.db.table.tb' ) );
	}
}

?>
