<?php
App::uses('Security', 'Utility');

/**
 * Utility
 *
 */
class Utility {

/**
 * Generates a secret (md5) based on URL parameters and a salt.
 *
 * @param array $params An array of URL parameters
 * @return string A secret
 */
	public static function secret($params) {
		$salt = Configure::read('SocialMedia.salt');

		return Security::hash(http_build_query($params), 'md5', $salt);
	}
}