<?php

namespace Controllers;

use Models\Users;
use Models\UserManager;


class UserController extends Controller
{
    public function index()
    {
        echo "Hello User Page!";
    }


 public function create()
    {
      if ($_SERVER['REQUEST_METHOD'] === 'POST') 
      {
      //VERIFICATIONS !
      $manager = new UserManager();
      $manager->insert($_POST);
      header("Location: /");      
      }
      echo $this->twig->render('user/register.html');

    }

 public function listing()
    {
      $userMapper = spot()->mapper('Models\Users');
      $userMapper->migrate();
      $userList = $userMapper->all();

      echo $this->twig->render('user/list.html',
        [
          "userList" => $userList,
          "quantity" => count($userList)
        ]
      );
    }
}