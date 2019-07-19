<?php

namespace Controllers;

use Models\Post;
use Models\PostManager;

use Models\Comment;
use Models\CommentManager;

use Models\MailManager;


class IndexController extends Controller
{
    public function index()
    {
        $manager = new PostManager();
        $posts =  $manager->getLastPost();
        $this->render('index/home-page.html', array('posts' => $posts, 'message' => "test"));
    }
    public function blog()
    {
        $this->render('index/category-page.html');
    }

    public function ajaxBlog() 
    {
        $return = array();
        $start = $_POST['start'];
        $manager = new PostManager();
        $posts =  $manager->getPostAjax($start, 9);
        foreach ($posts as $post) {
            $article = array();
            $article['name'] = $post->user->name;
            $article['firstname'] = $post->user->firstname;
            $article['subtitle'] = $post->subtitle;
            $article['title'] = $post->title;
            $article['image'] = $post->image;
            $article['id'] = $post->id;
            $article['created_date'] = $post->created_date->format('d-m-Y');
            array_push($return, $article);
        }


        echo json_encode($return);
    }

    public function contactMail() 
    {
        $name = trim($_POST['name']);
        $email = trim($_POST['email']);
        $message = trim($_POST['message']);
        $subject = trim($_POST['subject']);
        header('Content-Type: application/json');
        if ($name === ''){
        print json_encode(array('message' => 'Le nom ne peut pas être vide', 'code' => 'error'));
        exit();
        }
        if ($email === ''){
        print json_encode(array('message' => 'Le mail ne peut pas être vide', 'code' => 'error'));
        exit();
        } else {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
        print json_encode(array('message' => 'Format de mail invalide', 'code' => 'error'));
        exit();
        }
        }
        if ($subject === ''){
        print json_encode(array('message' => 'Le sujet ne peut pas être vide', 'code' => 'error'));
        exit();
        }
        if ($message === ''){
        print json_encode(array('message' => 'Le message ne peut pas être vide', 'code' => 'error'));
        exit();
        }
        $manager_mail = new MailManager();
        $uniqid = uniqid();
        $manager_mail->sendMail(
                    $email,
                    $subject,
                    $message
                );        
        echo json_encode(array('message' => 'Email envoyé !', 'code' => 'success'));
    }
}
