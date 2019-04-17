<?php

namespace Controllers;

class IndexController extends Controller
{
    public function index()
    {
        echo $this->twig->render('index/home-page.html');
    }

    public function ArticleShow($id) {
    	var_dump($id);
    	echo $this->twig->render('index/post-page.html');
    }
        public function blog() {

         echo $this->twig->render('index/category-page.html');
    }
}