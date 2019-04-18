<?php

namespace Models;

class Users extends \Spot\Entity
{
    protected static $table = 'users';

    public static function fields()
    {
      return [
        'id'        => ['type' => 'integer', 'primary' => true, 'autoincrement' => true],
        'name'      => ['type' => 'string', 'required' => true, 'unique' => true],
        'firstname' => ['type' => 'string', 'required' => true],
        'email'     => ['type' => 'string', 'required' => true],
        'password'  => ['type' => 'string', 'required' => true],
        'admin'     => ['type' => 'boolean', 'default' => false, 'value' => false]
      ];
    }
}