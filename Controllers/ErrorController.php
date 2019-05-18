<?php

namespace Controllers;

class ErrorController extends Controller
{
    public function error404()
    {
        $this->render('error/error404.html', array('title' => '404', 'message' => 'Oops! Page non trouvée.'));
    }
}
