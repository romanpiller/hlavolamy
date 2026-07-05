#!/usr/bin/env php
<?php declare(strict_types=1);

use RomanPiller\Console\Application;
use Nette\DI\Container;
use Nette\DI\ContainerLoader;
use Nette\DI\Extensions\ExtensionsExtension;

require __DIR__.'/../vendor/autoload.php';

// obtain the container
$loader = new ContainerLoader(__DIR__ . '/../temp', true);
$class = $loader->load(function ($compiler) {
    $compiler->addExtension('extensions', new ExtensionsExtension());
    $compiler->loadConfig(__DIR__ . '/../app/Config/config.neon');
});

/** @var Container $container */
$container = new $class();

/** @var Application $console */
$console = $container->getByType(Application::class);

exit($console->run());
