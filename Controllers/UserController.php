<?php

namespace Controllers;

use Models\Users;
use Models\UserManager;
use Models\MailManager;

class UserController extends Controller
{
    public function create()
    {
        if ($this->isPostAction()):

            if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) :

                if (strlen($_POST["mdp"]) >= '8') :

                    $manager = new UserManager();
                    $manager->insert($_POST);
                    $this->setFlashMessage('Votre compte a été crée avec succès', false, 'success');
                    header("Location: /login"); else:
                          $this->setFlashMessage('Le mot de passe doit contenir au moins 8 caractères', true, 'error');
                            $this->render('user/register.html');
                    endif; else:
                        $this->setFlashMessage('Adresse E-mail non comforme', true, 'warning');
                        $this->render('user/register.html');
                    endif; else:
                        $this->render('user/register.html');
                    endif;
    }

    public function login()
    {

        if ($this->isPostAction()):

            $manager = new UserManager();
            $check = $manager->check($_POST);
            if (!$check == false) :

                $_SESSION['user'] = $check;
                $this->setFlashMessage('Vous êtes connecté', false, 'success');
                header("Location: /account"); else:
                    $this->setFlashMessage('Erreur sur le mot de passe ou l\'email.', true, 'error');
                    $this->render('user/login.html');
                endif; else:

                    $this->render('user/login.html');

                endif;
    }



    public function logout()
    {
        session_destroy();
        session_start();
        $this->setFlashMessage('Vous êtes bien déconnecté', false, 'info');
        header("Location: /login");
    }

    public function account()
    {
        $admin = $this->getSession('user')->admin;
        $this->render('user/account.html', array('admin' => $admin));
    }

    public function reset_password()
    {
        if ($this->isPostAction()):
            $manager = new UserManager();
            $check = $manager->CheckEmail($_POST['email']);
            if (!$check == false) :

                $this->setFlashMessage('Un E-mail vous a été envoyé', true, 'info');
                $manager_mail = new MailManager();
                $uniqid = uniqid();
                $manager_mail->sendMail(
                    $_POST['email'],
                    'Demande de renouvellement de mot de passe',
                    'Cliquez sur ce lien pour modifier votre mot de passe </br><a href="' . $_SERVER['SERVER_NAME'] . '/reset-password/reset?token=' . $uniqid . '&mail='.$_POST['email'].'"</a> ' . $_SERVER['SERVER_NAME'] . '/reset-password/reset?token=' . $uniqid . ''
                );

                $manager->InsertToken($_POST['email'], $uniqid);

                $this->render('user/reset-password.html'); else:

                    $this->setFlashMessage('Aucun compte n\'existe avec cette adresse mail', true, 'info');
                    $this->render('user/reset-password.html');




                endif; else:
                    $this->render('user/reset-password.html');

                endif;
    }


    public function reset_password_reset($token, $mail)
    {
        $manager = new UserManager();
        $check = $manager->checkToken($token, $mail);

        if (!$check == false) :

            if ($this->isPostAction()):
                if (strlen($_POST["password"]) >= '8') :
                      $manager->updatePassword($_POST['password'], $mail);
                      
                    $this->setFlashMessage('Votre mot de passe a été modifié', true, 'success');
                    $this->render('user/login.html'); else:
                              $this->setFlashMessage('Le mot de passe doit contenir au moins 8 caractères', true, 'success');
                          $this->render('user/reset-password-reset.html');
                    endif; else:

                        $this->setFlashMessage('Vous pouvez modifier votre mot de passe !', true, 'info');
                        $this->render('user/reset-password-reset.html');

                    endif; else:

                        $this->setFlashMessage('Erreur', true, 'warning');
                        $this->render('user/login.html');
                    endif;

                    die;
    }

    public function information()
    {
        $manager = new UserManager();
        $user = $manager->information($this->getSession('user')->id);

        if ($this->isPostAction()):

            if (!is_dir("Public/img/user/". $user->id ."")) :
                mkdir("Public/img/user/". $user->id ."", 0777);
            endif;
            $uploaddir = 'Public/img/user/' . $user->id .'/';
            $uploadfile = $uploaddir . basename($_FILES['image']['name']);
            if (!empty($_FILES['image']['name'])) :
                move_uploaded_file($_FILES['image']['tmp_name'], $uploadfile); else:
                    $uploadfile = $this->getSession('user')->image;
                endif;

                $manager->updateInformation($_POST, $uploadfile, $this->getSession('user')->id);
                $this->getSession('user')->image = $uploadfile;
                $this->getSession('user')->name = $_POST['nom'];
                $this->getSession('user')->firstname = $_POST['prenom'];

                header("Location: /account"); else:

                    $this->render('user/information.html', array('user' => $user));

                endif;
    }
}
