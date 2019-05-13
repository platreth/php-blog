<?php

namespace Controllers;

use Models\Users;
use Models\UserManager;
use Models\MailManager;



class UserController extends Controller
{

 public function create()
    {
      if ($_SERVER['REQUEST_METHOD'] === 'POST') :

          if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)):

              if (strlen($_POST["mdp"]) >= '8'):

                $manager = new UserManager();
                $manager->insert($_POST);
                $this->setFlashMessage('Votre compte a été crée avec succès', false, 'success');
                 header("Location: /login");

              else:
                $this->setFlashMessage('Le mot de passe doit contenir au moins 8 caractères', true, 'error');
                echo $this->twig->render('user/register.html');   
              endif;

          else:
            $this->setFlashMessage('Adresse E-mail non comforme', true, 'warning');
            echo $this->twig->render('user/register.html');      
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

          $_SESSION['user'] = $check;
          $this->setFlashMessage('Vous êtes connecté', false, 'success');
          header("Location: /account");

        else:
          $this->setFlashMessage('Erreur sur le mot de passe ou l\'email.', true, 'error');
          echo $this->twig->render('user/login.html');      
        endif;
      
      else:

          echo $this->twig->render('user/login.html');

        endif;

    }



public function logout() {

        session_destroy();
        session_start();
        $this->setFlashMessage('Vous êtes bien déconnecté', false, 'info');
        header("Location: /login");
}

public function account() {

          $admin = $_SESSION['user']->admin;
          echo $this->twig->render('user/account.html', array('admin' => $admin));

}

public function reset_password() {



    if ($_SERVER['REQUEST_METHOD'] === 'POST'):
      $manager = new UserManager();
      $check = $manager->CheckEmail($_POST['email']);
      if (!$check == false):

        $this->setFlashMessage('Un E-mail vous a été envoyé', true, 'info');
        $manager_mail = new MailManager();
        $uniqid = uniqid();
        $manager_mail->sendMail($_POST['email'], 'Demande de renouvellement de mot de passe','Cliquez sur ce lien pour modifier votre mot de passe </br><a href="' . $_SERVER['SERVER_NAME'] . '/reset-password/' . $uniqid . '"</a> ' . $_SERVER['SERVER_NAME'] . '/reset-password/' . $uniqid . '');
        echo $this->twig->render('user/reset-password.html');


      else:

        $this->setFlashMessage('Aucun compte n\'existe avec cette adresse mail', true, 'info');
        echo $this->twig->render('user/reset-password.html');




      endif;

    else:
                  echo $this->twig->render('user/reset-password.html');





    endif;


}

public function information() {

          $manager = new UserManager();
          $user = $manager->information($_SESSION['user']->id);

      if ($_SERVER['REQUEST_METHOD'] === 'POST'):

        if (!is_dir("Public/img/user/". $user->id ."")):
          mkdir("Public/img/user/". $user->id ."", 0777);
        endif;
        $uploaddir = 'Public/img/user/' . $user->id .'/';
        $uploadfile = $uploaddir . basename($_FILES['image']['name']);
        if (!empty($_FILES['image']['name'])):
            move_uploaded_file($_FILES['image']['tmp_name'], $uploadfile);
        else:
            $uploadfile = $_SESSION['user']->image;
        endif;

          $manager->updateInformation($_POST, $uploadfile, $_SESSION['user']->id);
          $_SESSION['user']->image = $uploadfile;
          $_SESSION['user']->name = $_POST['nom'];
          $_SESSION['user']->firstname = $_POST['prenom'];

        header("Location: /account");

      else:

          echo $this->twig->render('user/information.html', array('user' => $user));

      endif;
    }
}