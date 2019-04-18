<?php

namespace Controllers;

class ErrorController extends Controller
{
    public function error404()
    {
        echo $this->twig->render('error/error404.html', array('title' => '404', 'message' => 'Oops! Page non trouvée.'));
    }

}