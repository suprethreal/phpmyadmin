<?php

declare(strict_types=1);

use PhpMyAdmin\Common;
use PhpMyAdmin\Core;
use PhpMyAdmin\Routing;

// phpcs:disable PSR1.Files.SideEffects
if (! defined('ROOT_PATH')) {
    define('ROOT_PATH', __DIR__ . DIRECTORY_SEPARATOR);
}

define('PHPMYADMIN', true);
// phpcs:enable

if (PHP_VERSION_ID < 70205) {
    die('<p>PHP 7.2.5+ is required.</p><p>Currently installed version is: ' . PHP_VERSION . '</p>');
}

require_once ROOT_PATH . 'libraries/constants.php';

if (! @is_readable(AUTOLOAD_FILE)) {
    die(
        '<p>File <samp>' . AUTOLOAD_FILE . '</samp> missing or not readable.</p>'
        . '<p>Most likely you did not run Composer to '
        . '<a href="https://docs.phpmyadmin.net/en/latest/setup.html#installing-from-git">'
        . 'install library files</a>.</p>'
    );
}

require AUTOLOAD_FILE;

Common::run();

Routing::callControllerForRoute(Common::getRequest(), Routing::getDispatcher(), Core::getContainerBuilder());
