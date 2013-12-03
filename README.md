# SocialMedia plugin for CakePHP

The SocialMedia plugin provides the tools to generate social media links (Helper) and handle them (Controller).

## Requirements

* CakePHP 2.0 or greater.
* PHP 5.3.0 or greater.

## Installation

* Clone/Copy the files in this directory into `app/Plugin/SocialMedia`

## Configuration

* Ensure the plugin is loaded in `app/Config/bootstrap.php` by calling:

```
CakePlugin::load('SocialMedia');
```

* Ensure to configure the following two lines in `app/Config/bootstrap.php`:

```
Configure::write('SocialMedia.salt', 'your-salt');
Configure::write('SocialMedia.facebookAppId', 'your-facebook-app-id');
```

## Usage

### Facebook share link

```
echo $this->SocialMedia->facebook(
	__('Share on Facebook'), array(
		'link' => 'your-url',
		'name' => 'your-name',
		'caption' => 'your-caption',
		'description' => 'your-description',
		'picture' => 'your-picture'
	)
);
```

### Twitter tweet link

```
echo $this->SocialMedia->twitter(
	__('Tweet on Twitter'), array(
		'url' => 'your-url',
		'via' => 'your-via',
		'text' => 'your-text',
	)
);
```