<?php

namespace Models;

use Models\Post;

class PostManager {

  public function insert($post, $path) {

          $userMapper = spot()->mapper('Models\Post');
          $userMapper->migrate();
          $newPost = $userMapper->create([
            'author'     => $_SESSION['id'],
            'title'     => $post['title'],
            'image'     => $path,
            'subtitle'  => $post['subtitle'],
            'content'     => $post['content'],
          ]);
}

  public function getMyPost() {
        $mapper = spot()->mapper('Models\Post');
        $mapper->migrate();
        $check = $mapper->where(['author' => $_SESSION['id']]);
        return $check;
  }

  public function getLastPost() {
        $mapper = spot()->mapper('Models\Post');
        $mapper->migrate();
        $check = $mapper->where(['status' => 'active'])
            ->order(['created_date' => 'DESC'])
            ->limit(6);
        return $check;
  }
}

