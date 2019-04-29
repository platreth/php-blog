<?php

namespace Controllers;

use \Twig_Loader_Filesystem;
use \Twig_Environment;

class Controller
{
    protected $twig;

     function __construct()
    {
      session_start();
      $className = substr(get_class($this), 12, -10);
      // Twig Configuration
      $loader = new Twig_Loader_Filesystem('./views/');
      $this->twig = new Twig_Environment($loader, array(
          'cache' => false,
      ));
      $this->twig->addGlobal('session', $_SESSION);
      $this->twig->addExtension(new \Twig_Extensions_Extension_Text());
      $this->getFlashMessage();
    }

     function setFlashMessage($message, $showimmediate = true, $type = 'success') {
      if (isset($_SESSION) && isset($_SESSION['flashmessage'])):
        if (isset($_SESSION['flashmessage'][$type])):
          array_push($_SESSION['flashmessage'][$type], $message);
        else:
          $_SESSION['flashmessage'][$type] = array($message);
        endif;
      elseif (isset($_SESSION)):
        $_SESSION['flashmessage'][$type] = array($message);
      endif;
      if ($showimmediate) {
        $this->getFlashMessage();
      }
    }
     function getFlashMessage() {

      if (isset($_SESSION) && isset($_SESSION['flashmessage'])):
        $this->twig->addGlobal('flashmessage', $_SESSION['flashmessage']);
        unset($_SESSION['flashmessage']);
      endif;




    }

}