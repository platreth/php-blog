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

	public function check($post) {

		$mapper = spot()->mapper('Models\Users');
        $mapper->migrate();
        $check = $mapper->first(['email' => $post['email'], 'password' => $post['mdp']]);
        return $check;

	}

}

