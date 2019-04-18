<?php

namespace Models;

use Models\Users;

class UserManager {

	public function insert($post) {

	  $userMapper = spot()->mapper('Models\Users');
      $userMapper->migrate();
      $myNewUser = $userMapper->create([
        'name'      => $post['nom'],
        'firstname' => $post['prenom'],
        'email'     => $post['email'],
        'password'  => $post['mdp']
      ]);
}

	public function check($post) {

		$mapper = spot()->mapper('Models\Users');
        $mapper->migrate();
        $check = $mapper->first(['email' => $post['email'], 'password' => $post['mdp']]);
        return $check;

	}

}

