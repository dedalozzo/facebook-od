<?php

/**
 * @file AbstractCommand.php
 * @brief This file contains the AbstractCommand class.
 * @details
 * @author Filippo F. Fadda
 */


//! This is the Commands namespace
namespace Facebook\ObjectDebugger\Command;


use Symfony\Component\Console\Command\Command;


/**
 * @brief This class represents an abstract command that implements the InjectionAwareInterface to automatic set the
 * Phalcon Dependency Injector and make it available to every subclasses.
 * @nosubgrouping
 */
abstract class AbstractCommand extends Command {

  /**
   * @brief Creates an instance of the command.
   */
  public function __construct() {
    parent::__construct();
  }

}