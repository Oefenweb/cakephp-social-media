<?php
namespace SocialMedia\Test\TestCase\View\Helper;

use Cake\Core\Configure;
use Cake\TestSuite\TestCase;
use Cake\View\View;
use SocialMedia\View\Helper\SocialMediaHelper;

/**
 * SocialMediaHelper Test Case.
 *
 */
class SocialMediaHelperTest extends TestCase
{

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
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
    public function tearDown()
    {
        unset($this->SocialMedia);

        parent::tearDown();
    }

    /**
     * Tests `facebook`.
     *
     * @return void
     */
    public function testFacebook()
    {
        $fullBaseUrl = Configure::read('App.fullBaseUrl');

        // Text link
        $title = __d('social_media', 'Share on Facebook');
        $urlParameters = [
            'link' => 'your-url',
            'name' => 'your-name',
            'caption' => 'your-caption',
            'description' => 'your-description',
            'picture' => 'your-picture',
            'redirect_uri' => $fullBaseUrl
        ];

        $actual = $this->SocialMedia->facebook($title, $urlParameters);
        $expected = implode('', [
            '<a href="https://www.facebook.com/dialog/feed?',
            'app_id=505567138750925&amp;',
            'redirect_uri=', urlencode($fullBaseUrl) . '&amp;',
            'link=your-url&amp;',
            'name=your-name&amp;',
            'caption=your-caption&amp;',
            'description=your-description&amp;',
            'picture=your-picture',
            '">', __d('social_media', 'Share on Facebook') . '</a>',
        ]);

        $this->assertEquals($expected, $actual);

        // Image link
        $image = '<img title="Facebook" src="/img/facebook.png">';
        $urlParameters = [
            'link' => 'your-url',
            'name' => 'your-name',
            'caption' => 'your-caption',
            'description' => 'your-description',
            'picture' => 'your-picture',
            'redirect_uri' => $fullBaseUrl,
        ];
        $options = ['escapeTitle' => false];

        $actual = $this->SocialMedia->facebook($image, $urlParameters, $options);
        $expected = implode('', [
            '<a href="https://www.facebook.com/dialog/feed?',
            'app_id=505567138750925&amp;',
            'redirect_uri=', urlencode($fullBaseUrl) . '&amp;',
            'link=your-url&amp;',
            'name=your-name&amp;',
            'caption=your-caption&amp;',
            'description=your-description&amp;',
            'picture=your-picture',
            '">', $image . '</a>',
        ]);

        $this->assertEquals($expected, $actual);
    }

    /**
     * Tests `twitter`.
     *
     * @return void
     */
    public function testTwitter()
    {
        // Text link
        $title = __d('social_media', 'Share on Twitter');
        $urlParameters = [
            'url' => 'your-url',
            'text' => 'your-text',
            'via' => 'your-via',
        ];

        $actual = $this->SocialMedia->twitter($title, $urlParameters);
        $expected = implode('', [
            '<a href="https://twitter.com/share?',
            'url=your-url&amp;',
            'text=your-text&amp;',
            'via=your-via',
            '">', __d('social_media', 'Share on Twitter') . '</a>',
         ]);

        $this->assertEquals($expected, $actual);

        // Image link
        $image = '<img title="Twitter" src="/img/twitter.png">';
        $urlParameters = [
            'url' => 'your-url',
            'text' => 'your-text',
            'via' => 'your-via',
        ];
        $options = ['escapeTitle' => false];

        $actual = $this->SocialMedia->twitter($image, $urlParameters, $options);
        $expected = implode('', [
            '<a href="https://twitter.com/share?',
            'url=your-url&amp;',
            'text=your-text&amp;',
            'via=your-via',
            '">', $image . '</a>',
        ]);

        $this->assertEquals($expected, $actual);
    }
}
