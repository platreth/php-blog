<?php

namespace Controllers;

use \Twig_Loader_Filesystem;
use \Twig_Environment;

class Controller
{
    protected $twig;

    function __construct()
    {
      $className = substr(get_class($this), 12, -10);
      // Twig Configuration
      $loader = new Twig_Loader_Filesystem('./views/' . strtolower($className));
      $this->twig = new Twig_Environment($loader, array(
          'cache' => false,
      ));
      //
    }
}