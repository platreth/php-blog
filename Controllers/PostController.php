<?php

namespace Controllers;

use Models\Users;
use Models\PostManager;

use Models\Comment;
use Models\CommentManager;

// POST =>
        // 'id'            => ['type' => 'integer', 'primary' => true, 'autoincrement' => true],
        // 'author'        => ['type' => 'integer', 'required' => true],
        // 'title'         => ['type' => 'string', 'required' => true, 'unique' => true],
        // 'image'         => ['type' => 'string', 'required' => true],
        // 'subtitle'      => ['type' => 'string', 'required' => true],
        // 'created_date'  => ['type' => 'datetime', 'required' => true, 'value' => $datetime],
        // 'modified_date' => ['type' => 'datetime', 'required' => true, 'value' => $datetime],
        // 'content'       => ['type' => 'text', 'required' => true],
        // 'status'       => ['type' => 'string', 'required' => true, 'value' => 'active'],

class PostController extends Controller
{

    // CREATION POST
    public function new()
    {
        // Si on passe en méthode POST alors on upload l'image du post et on l'insère en BDD sinon on affiche une erreur.
        //TODO : vérification champs formulaire
        if ($this->isPostAction()):

            $uploaddir = 'Public/img/post/';
        $uploadfile = $uploaddir . basename($this->getFile('image', 'name'));

        if (move_uploaded_file($this->getFile('image', 'tmp_name'), $uploadfile)) {
            $manager = new PostManager();
            $manager->insert($_POST, $uploadfile);
            $this->setFlashMessage('Votre post a été crée', true, 'success');
            $this->render('post/new-post.html');
        } else {
            $this->setFlashMessage('Erreur sur la création du post', true, 'error');
            $this->render('post/new-post.html', array('message' => 'erreur'));
        } else:
                //Affichage du formulaire si on arrive juste sur la page.
                $this->render('post/new-post.html');


        endif;
    }

    // AFFICHAGE DE MES POSTS
    public function mypost()
    {

        //On récupère les posts en fonction de l'utilisateur connecté et on les passe en paramètre.
        $manager = new PostManager();
        $posts =  $manager->getMyPost();
        $this->render('post/my-post.html', array('posts' => $posts));
    }

    // MODIFICATION D'UN POST
    public function edit($key)
    {
        $manager = new PostManager();
        $post = $manager->getPost($key);
        if ($this->isPostAction()):

            $uploaddir = 'Public/img/post/';
        $uploadfile = $uploaddir . basename($this->getFile('image', 'name'));
        if (!empty($this->getFile('image', 'name'))) :
                move_uploaded_file($this->getFile('image', 'tmp_name'), $uploadfile); else:
                    $uploadfile = $post->image;
        endif;
        $manager->updatePost($_POST, $post->id, $uploadfile);
        $this->setFlashMessage('Le post a bien été modifié', false, 'success');
        header("Location: /post/mypost"); else:

                    $this->render('post/edit-post.html', array('post' => $post));

        endif;
    }

    // SUPPRESSION D'UN POST
    public function delete()
    {
        $manager = new PostManager();
        $manager->deletePost($_GET['id']);
        $this->setFlashMessage('Le post a bien été supprimé', false, 'success');
        $this->redirect('/post/mypost');
    }
    // AFFICHAGE D'UN ARTICLE
    public function ArticleShow($key)
    {
        $manager = new PostManager();
        $post = $manager->getPost($key);

        $CommentManager = new CommentManager;
        $comment = $CommentManager->getComment($key);

        $manager = new PostManager();
        $post = $manager->getPost($key);
        $this->render('index/post-page.html', array('post' => $post, 'comments' => $comment));
    }

    public function addComment($key)
    {
        $comment_manager = new CommentManager();
        $comment_manager->createComment($key, $this->getSession('users')->id, $_POST['message']);

        //VERIFICATIONS
        $return = array();

        $return['type'] = 'info';
        $return['code'] = 200;
        $return['message'] = 'Le commentaire a été envoyé, il est en attente de validation.';
        echo json_encode($return);
    }
}
