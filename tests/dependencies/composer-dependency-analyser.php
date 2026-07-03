<?php declare(strict_types=1);
/**
 * https://github.com/shipmonk-rnd/composer-dependency-analyser
 */

use ShipMonk\ComposerDependencyAnalyser\Config\Configuration;

$config = new Configuration();
return $config
  ->addPathToScan(__DIR__ . '/../../app', false)
  ->addPathToScan(__DIR__ . '/../../bin', false)
  ->addPathToScan(__DIR__ . '/../../tests', true);
