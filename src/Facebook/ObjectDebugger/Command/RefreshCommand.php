<?php

/**
 * @file RefreshCommand.php
 * @brief This file contains the RefreshCommand class.
 * @details
 * @author Filippo F. Fadda
 */


namespace Facebook\ObjectDebugger\Console\Command;


use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputOption;


/**
 * @brief Scrapes pubs' information from WhatPub.
 * @nosubgrouping
 */
class RefreshCommand extends AbstractCommand {


  /**
   * @brief Configures the command.
   */
  protected function configure() {
    $this->setName("refresh");
    $this->setDescription("Fetches new scrape information and update the Facebook cache");

    $this->addOption("file",
      'i',
      InputOption::VALUE_REQUIRED,
      "Text file which contains a list of URLs, one per row");

    $this->addOption("url",
      'u',
      InputOption::VALUE_REQUIRED,
      "URL of a single page to scrape");
  }


  /**
   * @brief Executes the command.
   * @param[in] InputInterface $input The input interface
   * @param[in] OutputInterface $output The output interface
   * @retval string
   */
  protected function execute(InputInterface $input, OutputInterface $output) {
    if ($fileName = $input->getOption('file')) {
      $urls = file($fileName, FILE_IGNORE_NEW_LINES);

      if ($urls === FALSE)
        throw new \RuntimeException('Cannot open the file.');

      foreach ($urls as $url) {
        // todo: add code in here
      }
    }

    if ($city = urlencode($input->getOption('url'))) {
      // todo: add code in here
    }
  }

}