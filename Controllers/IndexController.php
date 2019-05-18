<?php

namespace Controllers;

use Models\Post;
use Models\PostManager;

use Models\Comment;
use Models\CommentManager;

class IndexController extends Controller
{
    public function index()
    {
        $manager = new PostManager();
        $posts =  $manager->getLastPost();
        $this->render('index/home-page.html', array('posts' => $posts, 'message' => "test"));
    }
    public function blog()
    {
        $manager = new PostManager();
        $posts =  $manager->getAllPost();
        $this->render('index/category-page.html', array('posts' => $posts));
    }
}
