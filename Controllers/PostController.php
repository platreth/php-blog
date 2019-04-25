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

  public function edit() {

      $manager = new PostManager();
      $post = $manager->getPost($_GET['id']);
      if ($_SERVER['REQUEST_METHOD'] === 'POST'):

          $uploaddir = 'Public/img/post/';
          $uploadfile = $uploaddir . basename($_FILES['image']['name']);

          if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadfile)):

            $manager->updatePost($_POST, $post->id, $uploadfile);

            header("Location: /");
        endif;

      else:

        echo $this->twig->render('post/edit-post.html', array('post' => $post));

      endif;

  }

  public function delete() {

     $manager = new PostManager();
      $post = $manager->deletePost($_GET['id']);
            header("Location: /");


  }

    public function ArticleShow($id) {
      var_dump($id);
      $manager = new PostManager();
      $post = $manager->getPost($id);
      echo $this->twig->render('index/post-page.html', array('post' => $post));
    }

}