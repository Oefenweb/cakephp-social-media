<?php
App::uses('Utility', 'SocialMedia.Lib');
App::uses('Helper', 'View');

/**
 * Social Media helper
 *
 * @property HtmlHelper $Html
 */
class SocialMediaHelper extends AppHelper {

/**
 * A so called "feed dialog" url for Facebook.
 *
 */
	const FACEBOOK_FEED_DIALOG_URL = 'https://www.facebook.com/dialog/feed';

/**
 * A so called "respect" url for Hyves.
 *
 */
	const HYVES_RESPECT_URL = 'http://www.hyves-share.nl/button/respect/';

/**
 * An array of names of helpers to load.
 *
 * @var array
 */
	public $helpers = array('Html');

/**
 * Creates a Facebook feed dialog link.
 *
 * ### Options
 *
 * - `app_id` Your application's identifier. Defaults to the configured SocialMedia.facebookAppId
 * - `redirect_uri` The URL to redirect to after the user clicks a button on the dialog. Defaults to the current url.
 * - `link` The link attached to this post. Defaults to the current url.
 * - `picture` The URL of a picture attached to this post.
 *             The picture must be at least 50px by 50px (though minimum 200px by 200px is preferred)
 *             and have a maximum aspect ratio of 3:1
 * - `name` The name of the link attachment.
 * - `caption` The caption of the link (appears beneath the link name).
 *             If not specified, this field is automatically populated with the URL of the link.
 * - `description` The description of the link (appears beneath the link caption).
 *                 If not specified, this field is automatically populated by information scraped from the link,
 *                 typically the title of the page.
 *
 * @param string $title The content to be wrapped by <a> tags.
 * @param array $options An array of options.
 * @return string An `<a />` element.
 */
	public function facebook($title, $options = array()) {
		$defaults = array(
			'app_id' => Configure::read('SocialMedia.facebookAppId'),
			'redirect_uri' => $this->Html->url('', true),
			'link' => $this->Html->url('', true)
		);
		$options = array_merge($defaults, $options);

		return $this->Html->link(
			$title, SocialMediaHelper::FACEBOOK_FEED_DIALOG_URL . '?' . http_build_query($options)
		);
	}

/**
 * Creates a Hyves Respect HTML link.
 *
 * ### Options
 *
 * - `escape` Set to false to disable escaping of title and attributes.
 * - `confirm` JavaScript confirmation message.
 *
 * @param string $title The content to be wrapped by <a> tags.
 * @param array $urlParameters An array of URL parameters
 * @param array $options An array of HTML attributes.
 * @param string $confirmMessage A javaScript confirmation message.
 * @return string An `<a />` element.
 */
	public function hyves($title, $urlParameters = array(), $options = array(), $confirmMessage = false) {
		$defaults = array(
			'url' => $this->Html->url('', true)
		);
		$urlParameters = array_merge($defaults, $urlParameters);

		foreach ($urlParameters as $key => $value) {
			$urlParameters[$key] = base64_encode($value);
		}

		$secret = Utility::secret($urlParameters);

		$url = array('plugin' => 'social_media', 'controller' => 'social_media', 'action' => 'display', $secret);
		$url = array_merge($url, $urlParameters);

		$params = array(
			'hc_hint' => 1,
			'url' => $this->Html->url($url, true)
		);

		return $this->Html->link(
			$title, SocialMediaHelper::HYVES_RESPECT_URL . '?' . http_build_query($params), $options, $confirmMessage
		);
	}
}