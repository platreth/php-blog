<?php

namespace Controllers;

use Models\Post;
use Models\PostManager;

class IndexController extends Controller
{
    public function index()
    {
        $manager = new PostManager();
        $posts =  $manager->getLastPost();
        echo $this->twig->render('index/home-page.html', array('posts' => $posts));
    }

    public function ArticleShow($id) {
    	var_dump($id);
    	echo $this->twig->render('index/post-page.html');
    }
        public function blog() {

         echo $this->twig->render('index/category-page.html');
    }
}