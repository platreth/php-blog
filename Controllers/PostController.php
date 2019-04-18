<?php

namespace Controllers;

use Models\Users;
use Models\PostManager;


class PostController extends Controller
{
    public function index()
    {
        echo "Hello User Page!";
    }


 public function new()
    {
      if ($_SERVER['REQUEST_METHOD'] === 'POST'):

        $uploaddir = 'Public/img/post/';
        $uploadfile = $uploaddir . basename($_FILES['image']['name']);

        if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadfile)) {

           $manager = new PostManager();
           $manager->insert($_POST, $uploadfile);

          echo $this->twig->render('post/new-post.html', array('message' => 'ok'));

        } 
        else 
        {
          echo $this->twig->render('post/new-post.html', array('message' => 'erreur'));

        }


      else:

      echo $this->twig->render('post/new-post.html');


      endif;
    }

  public function mypost() {

      $manager = new PostManager();
      $posts =  $manager->getMyPost();
      echo $this->twig->render('post/my-post.html', array('posts' => $posts));

  }


 public function listing()
    {
      $userMapper = spot()->mapper('Models\Users');
      $userMapper->migrate();
      $userList = $userMapper->all();

      echo $this->twig->render('list.html',
        [
          "userList" => $userList,
          "quantity" => count($userList)
        ]
      );
    }
}