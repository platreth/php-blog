<?php

namespace Models;

class Post extends \Spot\Entity
{
    protected static $table = 'post';

    public static function fields()
    {
        $datetime = new \DateTime('-3 days');
      return [
        'id'            => ['type' => 'integer', 'primary' => true, 'autoincrement' => true],
        'author'        => ['type' => 'integer', 'required' => true],
        'title'         => ['type' => 'string', 'required' => true, 'unique' => true],
        'image'         => ['type' => 'string', 'required' => true],
        'subtitle'      => ['type' => 'string', 'required' => true],
        'created_date'  => ['type' => 'datetime', 'required' => true, 'value' => $datetime],
        'modified_date' => ['type' => 'datetime', 'required' => true, 'value' => $datetime],
        'content'       => ['type' => 'string', 'required' => true],
      ];
    }
}