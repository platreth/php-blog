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
      if ($_SERVER['REQUEST_METHOD'] === 'POST') :

          if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)):

              if (strlen($_POST["mdp"]) >= '8'):

              $manager = new UserManager();
              $manager->insert($_POST);
              echo $this->twig->render('user/login.html', array('message' => 'Votre compte a été crée avec succès !'));  

              else:
                echo $this->twig->render('user/register.html', array('message' => 'Le mot de passe doit contenir au moins 8 caractères !'));   
              endif;

          else:
            echo $this->twig->render('user/register.html', array('message' => 'Adresse E-mail non comforme !'));      
          endif; 

    else:
      echo $this->twig->render('user/register.html');      
    endif;

    }

  public function login() 
    {

      if ($_SERVER['REQUEST_METHOD'] === 'POST'):

        $manager = new UserManager();
        $check = $manager->check($_POST);
        if (!$check == false):
          $_SESSION['id'] = $check->id;
          $_SESSION['name'] = $check->name;
          $_SESSION['firstname'] = $check->firstname;
        header("Location: /");
        else:
          echo $this->twig->render('user/login.html', array('message' => 'Erreur sur le mot de passe ou le mail.'));      
        endif;
      
      else:

          echo $this->twig->render('user/login.html');

        endif;

    }



public function logout() {

        $_SESSION = array();
        session_destroy();
        header("Location: /");
}

public function account() {

          echo $this->twig->render('user/account.html');

}

}