# SocialMedia plugin for CakePHP

[![Build Status](https://travis-ci.org/Oefenweb/cakephp-social-media.png?branch=master)](https://travis-ci.org/Oefenweb/cakephp-social-media) [![PHP 7 ready](http://php7ready.timesplinter.ch/Oefenweb/cakephp-social-media/badge.svg)](https://travis-ci.org/Oefenweb/cakephp-social-media) [![Coverage Status](https://coveralls.io/repos/Oefenweb/cakephp-social-media/badge.png)](https://coveralls.io/r/Oefenweb/cakephp-social-media) [![Packagist downloads](http://img.shields.io/packagist/dt/Oefenweb/cakephp-social-media.svg)](https://packagist.org/packages/oefenweb/cakephp-social-media) [![Code Climate](https://codeclimate.com/github/Oefenweb/cakephp-social-media/badges/gpa.svg)](https://codeclimate.com/github/Oefenweb/cakephp-social-media)

The SocialMedia plugin provides the tools to generate social media links (Helper) and handle them (Controller).

## Requirements

* CakePHP 2.4.2 or greater.
* PHP 5.4.16 or greater.

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
