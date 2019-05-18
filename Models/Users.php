<?php

namespace Models;

use \Spot\EntityInterface as Entity;
use \Spot\MapperInterface as Mapper;

class Users extends \Spot\Entity
{
    private $id;
    protected static $table = 'users';

    public static function fields()
    {
        return [
        'id'        => ['type' => 'integer', 'primary' => true, 'autoincrement' => true],
        'name'      => ['type' => 'string', 'required' => true, 'unique' => true],
        'firstname' => ['type' => 'string', 'required' => true],
        'image'     => ['type' => 'string', 'required' => true, 'value' => '/Public/img/user/user-profile.png'],
        'email'     => ['type' => 'string', 'required' => true],
        'password'  => ['type' => 'string', 'required' => true],
        'admin'     => ['type' => 'string', 'default' => false],
        'token'     => ['type' => 'string']
      ];
    }
}
