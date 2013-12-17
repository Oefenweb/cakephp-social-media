<?php
/**
 * All SocialMedia plugin tests
 */
class AllSocialMediaTest extends CakeTestCase {

/**
 * Suite define the tests for this plugin
 *
 * @return void
 */
	public static function suite() {
		$suite = new CakeTestSuite('All SocialMedia test');

		$path = CakePlugin::path('SocialMedia') . 'Test' . DS . 'Case' . DS;
		$suite->addTestDirectoryRecursive($path);

		return $suite;
	}

}
