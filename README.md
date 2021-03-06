[![Latest Stable Version](https://poser.pugx.org/3f/facebook-od/v/stable.png)](https://packagist.org/packages/3f/facebook-od)
[![Latest Unstable Version](https://poser.pugx.org/3f/facebook-od/v/unstable.png)](https://packagist.org/packages/3f/facebook-od)
[![Build Status](https://scrutinizer-ci.com/g/dedalozzo/facebook-od/badges/build.png?b=master)](https://scrutinizer-ci.com/g/dedalozzo/facebook-od/build-status/master)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/dedalozzo/facebook-od/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/dedalozzo/facebook-od/?branch=master)
[![License](https://poser.pugx.org/3f/facebook-od/license.svg)](https://packagist.org/packages/3f/facebook-od)
[![Total Downloads](https://poser.pugx.org/3f/facebook-od/downloads.png)](https://packagist.org/packages/3f/facebook-od)


Facebook Object Debugger CLI
============================
The Facebook Object Debugger CLI is command-line interface used to refresh the information of any page shared on 
Facebook. Unfortunately this operation can be done manually using the [Facebook Open Graph Object Debugger](https://developers.facebook.com/tools/debug/og/object/).
To overcome this limitation I have created this command-line interface, using the official [Facebook SDK for PHP](https://github.com/facebook/php-graph-sdk).


Composer Installation
---------------------

To install Facebook Object Debugger CLI, you first need to install [Composer](http://getcomposer.org/), a Package Manager 
for PHP, following those few [steps](http://getcomposer.org/doc/00-intro.md#installation-nix):

```sh
curl -s https://getcomposer.org/installer | php
```

You can run this command to easily access composer from anywhere on your system:

```sh
sudo mv composer.phar /usr/local/bin/composer
```


Facebook Object Debugger CLI Installation
-----------------------------------------
Once you have installed Composer, it's easy install Facebook Object Debugger CLI.

1.  Move into the directory where you prefer install Facebook Object Debugger CLI:
  ```sh
  cd /usr/local
  ```

2.  Create a project for Facebook Object Debugger CLI:
  ```sh
  sudo composer create-project 3f/facebook-od
  ```
  
3.  For your convenience create a symbolic link for the `fbod` executable in your `/usr/local/bin` directory:
  ```sh
  sudo ln -s /user/local/facebook-od/bin/fbod.php /usr/local/bin/fbod
  ```


Supported Commands
------------------
Lists commands. 
```sh
fbod list [--xml] [--raw] [--format="..."] [namespace]
```

Displays help for a command. 
```sh
fbod help [--xml] [--format="..."] [--raw] [command_name]
```

Fetches new scrape information and update the Facebook cache. 
```sh
fbod refresh [-i|--file[="..."]] [-u|--url[="..."]] 
  [-d|--id[="..."]] [-s|--secret[="..."]] [-t|--token[="..."]] 
  [-e|--encode]
```


Usage
-----
Using the Facebook Object Debugger CLI is really simple. You can refresh a single URL or a bunch of URLs providing a 
text file with a list of URLs, one for each line.

```sh
fbod refresh -u http://www.example.com/foo-bar-123
```

```sh
fbod refresh -i urls.txt
```

You must also provide an **App ID**, an **App Secret** and an **App Access Token** or a **User Access Token**. To see 
your token please use the [Access Token Tool](https://developers.facebook.com/tools/access_token/). You can use both 
the App Access Token or the User Access Token, just keep in mind the first one does not expire.
For your convenience you can rename (or copy) the `config.default.ini` to `config.ini`, then replace the 
values for your application. Otherwise you can provide those parameters using the designed options from the command-line.


Documentation
-------------
The documentation can be generated using [Doxygen](http://doxygen.org). A `Doxyfile` is provided for your convenience.


Requirements
------------
- PHP 5.4.0 or above.


Authors
-------
Filippo F. Fadda - <filippo.fadda@programmazione.it> - <http://www.linkedin.com/in/filippofadda>


License
-------
Facebook Object Debugger CLI is licensed under the Apache License, Version 2.0 - see the LICENSE file for details.
