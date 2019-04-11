<?php

namespace Controllers;

use Models\Users;

class PostController extends Controller
{
    public function index()
    {
        echo "Hello User Page!";
    }


 public function create()
    {

      $userMapper = spot()->mapper('Models\Post');
      $userMapper->migrate();
      $newPost = $userMapper->create([
        'id'      => 1,
        'author'     => 1,
        'title'     => 'test',
        'image'     => 'test',
        'subtitle'  => 'test',
        'created_date'     => null,
        'modified_date'     => null,
        'content'     => 'test',

      ]);
      echo "A new user has been created: " . $newPost->name;
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