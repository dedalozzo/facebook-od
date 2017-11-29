<?php

/**
 * @file Console.php
 * @brief This file contains the Console class.
 * @details
 * @author Filippo F. Fadda
 */


/**
 * @brief This namespace contains the Console class.
 */
namespace Facebook\ObjectDebugger;


use Symfony\Component\Console\Application;


/**
 * @brief This class extends the Application class of Symfony framework, with methods aim to set the Phalcon Dependency
 * Injector.
 */
class Console extends Application {

  /**
   * @var array $config
   */
  protected $config = [];


  /**
   * @brief Gets the configuration settings.
   * @return array
   */
  public function getConfig() {
    return $this->config;
  }


  /**
   * @brief Provides the configuration settings to the console.
   * @param array $config An array with the configuration settings.
   */
  public function setConfig(array $config) {
    $this->config = $config;
  }

}