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
            header("Location: /");
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

    public function approve($id)
    {
        $this->checkAdmin();
        $manager = new CommentManager();
        $manager->approveComment($id);
        $this->setFlashMessage('Commentaire approuvé', false, 'success');
        header("Location: /admin/comment");
    }

    public function delete($id)
    {
        $this->checkAdmin();
        $manager = new CommentManager();
        $manager->deleteComment($id);
        $this->setFlashMessage('Commentaire supprimé', false, 'success');
        header("Location: /admin/comment");
    }

    public function grantUser($id)
    {
        $this->checkAdmin();
        $manager = new UserManager();
        $manager->grant($id);
        $this->setFlashMessage('L\'utilisateur est maintenant admin !', false, 'success');
        header("Location: /admin/user");
    }
}
