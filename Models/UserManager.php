
<?php
namespace Models;

use Models\Users;

class UserManager {

	public function insert($post) {

	$userMapper = spot()->mapper('Models\Users');
      $userMapper->migrate();
      $myNewUser = $userMapper->create([
        'name'      => $post['name'],
        'email'     => $post['email'],
        'password'  => $post['password']
      ]);
}

}

