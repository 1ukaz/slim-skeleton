<?php
// DIC configuration

use Facebook\FacebookApp;
use Facebook\FacebookRequest;
use Facebook\Facebook;

$container = $app->getContainer();

// monolog
$container['logger'] = function ($c) {
    $settings = $c->get('settings')['logger'];
    $logger = new Monolog\Logger($settings['name']);
    $logger->pushProcessor(new Monolog\Processor\UidProcessor());
    $logger->pushHandler(new Monolog\Handler\StreamHandler($settings['path'], $settings['level']));
    return $logger;
};

// Facebook Request instance
$container['fbRequest'] = function ($c) {
    $fbApp = new FacebookApp(
        $c->get('settings')['facebook']['app_id'],
        $c->get('settings')['facebook']['app_secret']
    );
    $fbRequest = new FacebookRequest($fbApp, $c->get('settings')['facebook']['app_token']);
    return $fbRequest;
};

// Facebook App instance
$container['fbObject'] = function ($c) {
    return new Facebook($c->get('settings')['facebook']);
};
