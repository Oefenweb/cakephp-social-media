<?php
namespace SocialMedia\View\Helper;

use Cake\Core\Configure;
use Cake\View\Helper;

/**
 * Social Media helper
 *
 * @property HtmlHelper $Html
 */
class SocialMediaHelper extends Helper
{

    /**
     * A so called "feed dialog" url for Facebook.
     *
     */
    const FACEBOOK_FEED_DIALOG_URL = 'https://www.facebook.com/dialog/feed';

    /**
     * A so called "tweet" url for Twitter.
     *
     */
    const TWITTER_TWEET_URL = 'https://twitter.com/share';

    /**
     * An array of names of helpers to load.
     *
     * @var array
     */
    public $helpers = ['Html', 'Url'];

    /**
     * Creates a Facebook feed dialog link.
     *
     *  - Url parameters:
     *    - `app_id` Your application's identifier. Defaults to the configured SocialMedia.facebookAppId
     *    - `redirect_uri` The URL to redirect to after the user clicks a button on the dialog. Defaults to the current url.
     *    - `link` The link attached to this post. Defaults to the current url.
     *    - `picture` The URL of a picture attached to this post.
     *                The picture must be at least 50px by 50px (though minimum 200px by 200px is preferred)
     *                and have a maximum aspect ratio of 3:1
     *    - `name` The name of the link attachment.
     *    - `caption` The caption of the link (appears beneath the link name).
     *                If not specified, this field is automatically populated with the URL of the link.
     *    - `description` The description of the link (appears beneath the link caption).
     *                    If not specified, this field is automatically populated by information scraped from the link,
     *                    typically the title of the page.
     *
     *  - Options:
     *    - `escape` Set to false to disable escaping of title and attributes
     *
     * @param string $title The content to be wrapped by <a> tags
     * @param array $urlParameters An array of URL parameters
     * @param array $options An array of HTML attributes
     * @param string $confirmMessage A javaScript confirmation message
     * @return string An `<a />` element.
     */
    public function facebook(string $title, array $urlParameters = [], array $options = [], string $confirmMessage = ''): string
    {
        $defaults = [
            'app_id' => Configure::read('SocialMedia.facebookAppId'),
            'redirect_uri' => $this->Url->build('', true),
            'link' => $this->Url->build('', true)
        ];

        $scheme = parse_url(static::FACEBOOK_FEED_DIALOG_URL, PHP_URL_SCHEME);

        return $this->Html->link($title, [
                '_scheme' => $scheme,
                '_host' => preg_replace('|^' . $scheme . '://|', '', static::FACEBOOK_FEED_DIALOG_URL),
                '?' => array_merge($defaults, $urlParameters)
            ], $options, $confirmMessage);
    }

    /**
     * Creates a Twitter Tweet link.
     *
     *  - Url parameters:
     *    - `url` URL of the page to share
     *    - `via` Screen name of the user to attribute the Tweet to
     *    - `text` Default Tweet text
     *
     *  - Options:
     *    - `escape` Set to false to disable escaping of title and attributes
     *
     * @param string $title The content to be wrapped by <a> tags
     * @param array $urlParameters An array of URL parameters
     * @param array $options An array of HTML attributes
     * @param string $confirmMessage A javaScript confirmation message
     * @return string An `<a />` element.
     */
    public function twitter(string $title, array $urlParameters = [], array $options = [], string $confirmMessage = '')
    {
        $defaults = ['url' => $this->Url->build('', true)];

        $scheme = parse_url(static::FACEBOOK_FEED_DIALOG_URL, PHP_URL_SCHEME);

        return $this->Html->link($title, [
                '_scheme' => $scheme,
                '_host' => preg_replace('|^' . $scheme . '://|', '', static::TWITTER_TWEET_URL),
                '?' => array_merge($defaults, $urlParameters)
            ], $options, $confirmMessage);
    }
}
