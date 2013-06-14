<?php
App::uses('Utility', 'SocialMedia.Lib');
App::uses('SocialMediaAppController', 'SocialMedia.Controller');

/**
 * SocialMedia Controller
 *
 */
class SocialMediaController extends SocialMediaAppController {

/**
 *
 * @return void
 */
	public function beforeFilter() {
		parent::beforeFilter();

		if ($this->Components->enabled('Auth')) {
			$this->Auth->allow('display');
		}
	}

/**
 *
 * @return void
 * @throws NotFoundException
 */
	public function display($secret) {
		$defaults = array(
			'title' => '',
			'type' => 'website',
			'url' => Router::url('', true),
			'image' => '',
			'description' => ''
		);

		$this->layout = 'open_graph';

		$options = $this->request->params['named'];

		if ($secret !== Utility::secret($options)) {
			throw new NotFoundException();
		}

		foreach ($options as $key => $value) {
			$options[$key] = base64_decode($value);
		}

		$options = array_merge($defaults, $options);

		$this->set(compact('options'));
	}
}