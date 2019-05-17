<?php

namespace Drupal\d8custom\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

class D8WeatherConfigForm extends ConfigFormBase {
	protected function getEditableConfigNames() {
		return [
				'd8custom.weather.manager'
		];
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
		return 'd8custom.weather.manager';
	}

	/**
	 *
	 * {@inheritdoc}
	 *
	 */
	public function buildForm(array $form, FormStateInterface $form_state) {
		$form ['app_id'] = [
				'#type' => 'textfield',
				'title' => 'App Id',
				'Discription' => 'App Id for my Openweathermap access',
				'#default_value' => $this->config ( 'd8custom.weather.manager' )->get ( 'app_id' )
		];

		return parent::buildform ( $form, $form_state );
	}

	/**
	 *
	 * {@inheritdoc}
	 *
	 */
	public function submitForm(array &$form, FormStateInterface $form_state) {
		$this->config ( 'd8custom.weather.manager' )->set ( 'app_id', $form_state->getValue ( 'app_id' ) )->save ();
		parent::submitform ( $form, $form_state );
	}
}
?>
