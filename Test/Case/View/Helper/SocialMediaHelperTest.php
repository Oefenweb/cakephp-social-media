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
		$title = __d('social_media', 'Share on Facebook');
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
								'">' . __d('social_media', 'Share on Facebook') . '</a>';

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

	public function testTwitter() {
		// Text link
		$title = __d('social_media', 'Share on Twitter');
		$urlParameters = array(
			'url' => 'your-url',
			'text' => 'your-text',
			'via' => 'your-via'
		);

		$result = $this->SocialMedia->twitter($title, $urlParameters);
		$expected = '<a href="https://twitter.com/share?' .
								'url=your-url&amp;' .
								'text=your-text&amp;' .
								'via=your-via' .
								'">' . __d('social_media', 'Share on Twitter') . '</a>';

		$this->assertEqual($result, $expected);
	}

}
