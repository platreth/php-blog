<?php

namespace Controllers;

use Models\Users;
use Models\UserManager;


class PostController extends Controller
{
    public function index()
    {
        echo "Hello User Page!";
    }


 public function create()
    {
      if ($_SERVER['REQUEST_METHOD'] === 'POST'){

          $userMapper = spot()->mapper('Models\Post');
          $userMapper->migrate();
          $newPost = $userMapper->create([
            'id'      => 1,
            'author'     => 1,
            'title'     => 'test',
            'image'     => 'test',
            'subtitle'  => 'test',
            'created_date'     => new \Datetime(),
            'modified_date'     => new \Datetime(),
            'content'     => 'test',
          ]);
      }

      
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