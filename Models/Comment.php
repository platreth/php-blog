<?php

namespace Models;
use \Spot\EntityInterface as Entity;
use \Spot\MapperInterface as Mapper;
use Models\Users;


class Comment extends \Spot\Entity 
{
    protected static $table = 'comment';

    public static function fields()
    {
        $datetime = new \DateTime();
      return [
        'id'            => ['type' => 'integer', 'primary' => true, 'autoincrement' => true],
        'author'        => ['type' => 'integer', 'required' => true],
        'id_post'       => ['type' => 'integer', 'required' => true],
        'created_date'  => ['type' => 'datetime', 'required' => true, 'value' => $datetime],
        'content'       => ['type' => 'text', 'required' => true],
        'status'       => ['type' => 'string', 'required' => true, 'value' => '0'],
      ];
    }
    public static function relations(Mapper $mapper, Entity $entity)
    {
        return [
            'user' => $mapper->belongsTo($entity, 'Models\Users', 'author'),
            'post' => $mapper->belongsTo($entity, 'Models\Post', 'id_post')

        ];
    }
}