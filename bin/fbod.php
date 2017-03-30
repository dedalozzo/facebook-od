#! /usr/bin/php
<?php

/**
 * @file fbod.php
 * @brief Facebook Object Debugger Command-Line Interface.
 * @details
 * @author Filippo F. Fadda
 */


if (PHP_SAPI !== 'cli')
  echo 'Warning: Facebook Object Debugger CLI should be invoked via the CLI version of PHP, not the '.PHP_SAPI.' SAPI.';


error_reporting(E_ALL & ~(E_NOTICE | E_STRICT));

$loader = require_once __DIR__ . "/../vendor/autoload.php";


use Facebook\ObjectDebugger\Console;
use Facebook\ObjectDebugger\Command;

use Monolog\Logger;
use Monolog\ErrorHandler;
use Monolog\Handler\StreamHandler;


$start = microtime(TRUE);

try {
  $root = realpath(__DIR__."/../");

  // Initializes the Composer autoloading system. (Note: We don't use the Phalcon loader.)
  require $root."/vendor/autoload.php";

  $log = new Logger('couch');

  // Registers the Monolog error handler to log errors and exceptions.
  ErrorHandler::register($log);

  // Creates a stream handler to log debugging messages.
  $log->pushHandler(new StreamHandler($root.'/log/fbod.log', Logger::DEBUG));

  // Creates the application object.
  $console = new Console('Facebook Object Debugger CLI');
  //$console->setCatchExceptions(FALSE);

  // Reads the application's configuration.
  if ($config = parse_ini_file($root.'/etc/config.ini'))
    $console->setConfig($config);

  $console->add(new Command\RefreshCommand());

  $console->run();
}
catch (Exception $e) {
  echo $e;
}