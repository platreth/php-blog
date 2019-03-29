<?php

namespace Controllers;

use Models\Users;

class UserController extends Controller
{
    public function index()
    {
        echo "Hello User Page!";
    }


 public function create($params)
    {
      if (!isset($params['name'])) {
        $name = "Example";
      } else {
        $name = $params['name'];
      }
      $userMapper = spot()->mapper('Models\Users');
      $userMapper->migrate();
      $myNewUser = $userMapper->create([
        'name'      => $name,
        'email'     => 'example@example.example',
        'password'  => '123456789'
      ]);
      echo "A new user has been created: " . $myNewUser->name;
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