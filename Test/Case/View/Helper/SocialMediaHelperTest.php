<?php
App::uses('View', 'View');
App::uses('Helper', 'View');
App::uses('SocialMediaHelper', 'SocialMedia.View/Helper');
App::uses('Utility', 'SocialMedia.Lib');

/**
 * SocialMediaHelper Test Case
 *
 */
class SocialMediaHelperTest extends CakeTestCase {

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();

		Configure::write('SocialMedia.salt', '7Nh6AmgdkBXr0afrQObG79J+gXtMXrDYTnKlQxrhoYnXMXPrj3eMLALQfyCiNsVc');
		Configure::write('SocialMedia.facebookAppId', 505567138750925);

		$View = new View();
		$this->SocialMedia = new SocialMediaHelper($View);
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->SocialMedia);

		parent::tearDown();
	}

	public function testFacebook() {
		// Text link
		$title = __('Share on Facebook');
		$urlParameters = array(
			'link' => 'your-url',
			'name' => 'your-name',
			'caption' => 'your-caption',
			'description' => 'your-description',
			'picture' => 'your-picture',
			'redirect_uri' => FULL_BASE_URL
		);

		$result = $this->SocialMedia->facebook($title, $urlParameters);
		$expected = '<a href="https://www.facebook.com/dialog/feed?' .
								'app_id=505567138750925&amp;' .
								'redirect_uri=' . urlencode(FULL_BASE_URL) . '&amp;' .
								'link=your-url&amp;' .
								'name=your-name&amp;' .
								'caption=your-caption&amp;' .
								'description=your-description&amp;' .
								'picture=your-picture' .
								'">' . __('Share on Facebook') . '</a>';

		$this->assertEqual($result, $expected);

		// Image link
		$title = '<img title="Facebook" src="/img/facebook.png">';
		$urlParameters = array(
			'link' => 'your-url',
			'name' => 'your-name',
			'caption' => 'your-caption',
			'description' => 'your-description',
			'picture' => 'your-picture',
			'redirect_uri' => FULL_BASE_URL
		);
		$options = array('escape' => false);

		$result = $this->SocialMedia->facebook($title, $urlParameters, $options);
		$expected = '<a href="https://www.facebook.com/dialog/feed?' .
								'app_id=505567138750925&amp;' .
								'redirect_uri=' . urlencode(FULL_BASE_URL) . '&amp;' .
								'link=your-url&amp;' .
								'name=your-name&amp;' .
								'caption=your-caption&amp;' .
								'description=your-description&amp;' .
								'picture=your-picture' .
								'">' . '<img title="Facebook" src="/img/facebook.png">' . '</a>';

		$this->assertEqual($result, $expected);
	}

	public function testHyves() {
		// Text link
		$title = __('Share on Hyves');
		$urlParameters = array(
			'url' => 'your-url',
			'title' => 'your-title',
			'description' => 'your-description',
			'image' => 'your-image'
		);

		$result = $this->SocialMedia->hyves($title, $urlParameters);
		$expected = '<a href="http://www.hyves-share.nl/button/respect/?' .
								'hc_hint=1&amp;' .
								'url=' . urlencode(FULL_BASE_URL) . '%2Fsocial_media%2Fsocial_media%2Fdisplay%2Fcd33a621e2052efcf7cff474d6ea335f%2Furl%3AeW91ci11cmw%253D%2Ftitle%3AeW91ci10aXRsZQ%253D%253D%2Fdescription%3AeW91ci1kZXNjcmlwdGlvbg%253D%253D%2Fimage%3AeW91ci1pbWFnZQ%253D%253D' .
								'">' . __('Share on Hyves') . '</a>';

		$this->assertEqual($result, $expected);

		// Image link
		$title = '<img title="Hyves" src="/img/hyves.png">';
		$urlParameters = array(
			'url' => 'your-url',
			'title' => 'your-title',
			'description' => 'your-description',
			'image' => 'your-image'
		);
		$options = array('escape' => false);

		$result = $this->SocialMedia->hyves($title, $urlParameters, $options);
		$expected = '<a href="http://www.hyves-share.nl/button/respect/?' .
								'hc_hint=1&amp;' .
								'url=' . urlencode(FULL_BASE_URL) . '%2Fsocial_media%2Fsocial_media%2Fdisplay%2Fcd33a621e2052efcf7cff474d6ea335f%2Furl%3AeW91ci11cmw%253D%2Ftitle%3AeW91ci10aXRsZQ%253D%253D%2Fdescription%3AeW91ci1kZXNjcmlwdGlvbg%253D%253D%2Fimage%3AeW91ci1pbWFnZQ%253D%253D' .
								'">' . '<img title="Hyves" src="/img/hyves.png">' . '</a>';

		$this->assertEqual($result, $expected);
	}

}
