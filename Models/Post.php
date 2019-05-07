<?php

namespace Models;
use \Spot\EntityInterface as Entity;
use \Spot\MapperInterface as Mapper;
use Models\Users;


class Post extends \Spot\Entity 
{
    protected static $table = 'post';

    public static function fields()
    {
        $datetime = new \DateTime();
      return [
        'id'            => ['type' => 'integer', 'primary' => true, 'autoincrement' => true],
        'author'        => ['type' => 'integer', 'required' => true],
        'title'         => ['type' => 'string', 'required' => true],
        'image'         => ['type' => 'string', 'required' => true],
        'subtitle'      => ['type' => 'string', 'required' => true],
        'created_date'  => ['type' => 'datetime', 'required' => true, 'value' => $datetime],
        'modified_date' => ['type' => 'datetime', 'required' => true, 'value' => $datetime],
        'content'       => ['type' => 'text', 'required' => true],
        'status'       => ['type' => 'string', 'required' => true, 'value' => 'active'],

      ];
    }
    public static function relations(Mapper $mapper, Entity $entity)
    {
        return [
            'user' => $mapper->belongsTo($entity, 'Models\Users', 'author')
        ];
    }
}