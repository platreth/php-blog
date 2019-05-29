<?php

namespace Controllers;

use Models\Users;
use Models\PostManager;
use Models\UserManager;


use Models\Comment;
use Models\CommentManager;

class AdminController extends Controller
{
    public function checkAdmin()
    {
        $user = $this->getSession('user');
        if ($user->admin != 1) {
            $this->setFlashMessage('L\'accès à cette page n\'est pas autorisé', false, 'warning');
            $this->redirect('/');
        }
    }

    public function comment()
    {
        $this->checkAdmin();
        $manager = new CommentManager();
        $comments = $manager->getWaitingValidationComment();
        $this->render('admin/admin-comment.html', array('comments' => $comments));
    }

    public function user()
    {
        $this->checkAdmin();
        $manager = new UserManager();
        $users = $manager->getAllUsers();
        $this->render('admin/admin-user.html', array('users' => $users));
    }

    public function approve($key)
    {
        $this->checkAdmin();
        $manager = new CommentManager();
        $manager->approveComment($key);
        $this->setFlashMessage('Commentaire approuvé', false, 'success');
        $this->redirect('/admin/comment');
    }

    public function delete($key)
    {
        $this->checkAdmin();
        $manager = new CommentManager();
        $manager->deleteComment($key);
        $this->setFlashMessage('Commentaire supprimé', false, 'success');
        $this->redirect('/admin/comment');
    }

    public function grantUser($key)
    {
        $this->checkAdmin();
        $manager = new UserManager();
        $manager->grant($key);
        $this->setFlashMessage('L\'utilisateur est maintenant admin !', false, 'success');
        $this->redirect('/admin/user');
    }
}
