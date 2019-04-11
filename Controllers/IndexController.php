<?php

namespace Controllers;

class IndexController extends Controller
{
    public function index()
    {
        echo $this->twig->render('home-page.html');
    }

    public function ArticleShow($id) {
    	var_dump($id);
    	echo $this->twig->render('post-page.html');
    }
        public function blog() {

         echo $this->twig->render('category-page.html');
    }
}