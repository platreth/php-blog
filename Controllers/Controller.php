<?php

namespace Controllers;

use \Twig_Loader_Filesystem;
use \Twig_Environment;

class Controller
{
    protected $twig;

    public function __construct()
    {
        session_start();
        $className = substr(get_class($this), 12, -10);
        // Configuration de twig
        $loader = new Twig_Loader_Filesystem('./views/');
        $this->twig = new Twig_Environment(
            $loader, array(
            'cache' => false,
            )
        );
        // Ajout du tableau de session en globale pour TWIG
        $this->twig->addGlobal('session', $_SESSION);
        // Extension twig pour couper un texte et faire une preview
        $this->twig->addExtension(new \Twig_Extensions_Extension_Text());
        // Appel de la fonction au cas où on ne veut pas l'afficher immédiatement.
        $this->getFlashMessage();
    }


    // FONCTION SET POUR LES FLASH MESSAGE
    public function setFlashMessage($message, $showimmediate = true, $type = 'success')
    {
        if (isset($_SESSION) && isset($_SESSION['flashmessage'])) :
            if (isset($_SESSION['flashmessage'][$type])) :
                array_push($_SESSION['flashmessage'][$type], $message); else:
                    $_SESSION['flashmessage'][$type] = array($message);
                endif; elseif (isset($_SESSION)) :
                    $_SESSION['flashmessage'][$type] = array($message);
                endif;
                if ($showimmediate) {
                    $this->getFlashMessage();
                }
    }

    // FONCTION GET POUR LES FLASH MESSAGE
    public function getFlashMessage()
    {
        if (isset($_SESSION) && isset($_SESSION['flashmessage'])) :
            $this->twig->addGlobal('flashmessage', $_SESSION['flashmessage']);
            unset($_SESSION['flashmessage']);
        endif;
    }
}


// TODO

// DIAGRAMME UML
// CODACY
// PAGINATION PAGE BLOG POST
// COMMENTAIRE AJAX
// COMMENTAIRES PHP DOC
// RESPONSIVE
// SUPPR COMMENTAIRE LORS DE SUPPR POST
