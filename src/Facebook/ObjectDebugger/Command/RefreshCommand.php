<?php

/**
 * @file RefreshCommand.php
 * @brief This file contains the RefreshCommand class.
 * @details
 * @author Filippo F. Fadda
 */


namespace Facebook\ObjectDebugger\Command;


use Symfony\Component\Console\Exception\InvalidOptionException;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputOption;

use Facebook\Facebook;


/**
 * @brief Scrapes pubs' information from WhatPub.
 * @nosubgrouping
 */
class RefreshCommand extends AbstractCommand {

  /**
   * @var Facebook $fb
   */
  private $fb;

  /**
   * @var InputInterface $input
   */
  private $input;

  /**
   * @var OutputInterface $output
   */
  private $output;


  /**
   * @brief Fetches new scrape information and update the Facebook cache.
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

    $this->addOption("id",
      'd',
      InputOption::VALUE_REQUIRED,
      "Facebook id");

    $this->addOption("secret",
      's',
      InputOption::VALUE_REQUIRED,
      "Facebook secret");

    $this->addOption("token",
      't',
      InputOption::VALUE_REQUIRED,
      "Facebook App|User access token");

    $this->addOption("encode",
      'e',
      InputOption::VALUE_NONE,
      "Encode the provided URL");
  }


  /**
   * @brief Scrapes the information.
   * @param[in] string $url The page URL to scrape.
   */
  private function scrape($url) {
    $this->output->write($url);

    if ($this->input->getOption('encode'))
      $url = urlencode($url);

    $params = [
      'id' => $url,
      'scrape' => 'true'
    ];

    $response = $this->fb->post('/', $params);

    $this->output->writeln(' => done');
  }


  /**
   * @brief Executes the command.
   * @param[in] InputInterface $input The input interface
   * @param[in] OutputInterface $output The output interface
   * @retval string
   */
  protected function execute(InputInterface $input, OutputInterface $output) {
    $this->input = $input;
    $this->output = $output;

    $config = $this->getApplication()->getConfig();

    if ($input->getOption('id'))
      $appId = $input->getOption('id');
    elseif (array_key_exists('appId', $config))
      $appId = $config['appId'];
    else
      throw new InvalidOptionException('Facebook Open Graph requires an App ID.');

    if ($input->getOption('secret'))
      $appSecret = $input->getOption('secret');
    elseif (array_key_exists('appSecret', $config))
      $appSecret = $config['appSecret'];
    else
      throw new InvalidOptionException('Facebook Open Graph requires an App Secret.');

    if ($input->getOption('token'))
      $accessToken = $input->getOption('token');
    elseif (array_key_exists('appAccessToken', $config))
      $accessToken = $config['appAccessToken'];
    else
      throw new InvalidOptionException('Facebook Open Graph requires an App|User Access Token.');

    $this->fb = new Facebook([
      'app_id' => $appId,
      'app_secret' => $appSecret,
      'default_access_token' => $accessToken,
      'default_graph_version' => 'v2.8',
    ]);

    if ($url = $input->getOption('url')) {
      $this->scrape($url);
    }
    elseif ($fileName = $input->getOption('file')) {
      $urls = file($fileName, FILE_IGNORE_NEW_LINES);

      if ($urls === FALSE)
        throw new \RuntimeException('Cannot open the file.');

      foreach ($urls as $url)
        $this->scrape($url);
    }
  }

}