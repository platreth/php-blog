<?php

namespace Controllers;

class IndexController extends Controller
{
    public function index()
    {
        echo $this->twig->render('home-page.html');
    }

    public function ArticleShow($id) {
    	echo $id;
    }
}