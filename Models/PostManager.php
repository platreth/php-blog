<?php

namespace Models;

use Models\Post;

class PostManager
{
    public function insert($post, $path)
    {
        $userMapper = spot()->mapper('Models\Post');
        $userMapper->migrate();
        $userMapper->create(
            [
            'author'     => $_SESSION['users']->id,
            'title'     => $post['title'],
            'image'     => $path,
            'subtitle'  => $post['subtitle'],
            'content'     => $post['content'],
            ]
        );
    }

    public function getMyPost()
    {
        $mapper = spot()->mapper('Models\Post');
        $mapper->migrate();
        $check = $mapper->where(['author' => $_SESSION['users']->id])
            ->order(['created_date' => 'DESC']);
        return $check;
    }

    public function getLastPost()
    {
        $mapper = spot()->mapper('Models\Post');
        $mapper->migrate();
        $check = $mapper->where(['status' => 'active'])
            ->order(['created_date' => 'DESC'])
            ->limit(3);
        return $check;
    }

    public function getAllPost()
    {
        $mapper = spot()->mapper('Models\Post');
        $mapper->migrate();
        $check = $mapper->where(['status' => 'active'])
            ->order(['created_date' => 'DESC']);
        return $check;
    }

    public function getPost($key)
    {
        $mapper = spot()->mapper('Models\Post');
        $mapper->migrate();
        $check = $mapper->first(['id' => $key]);
        return $check;
    }

    public function updatePost($post, $key, $image)
    {
        $mapper = spot()->mapper('Models\Post');
        $entity = $mapper->first(['id' => $key]);
        $entity->title = $post['title'];
        $entity->subtitle = $post['subtitle'];
        $entity->content = $post['content'];
        $entity->image = $image;
        $entity->modified_date = new \DateTime();
        $mapper->update($entity);
    }

    public function deletePost($key)
    {
        $mapper = spot()->mapper('Models\Post');
        $entity = $mapper->first(['id' => $key]);
        $mapper->delete($entity);
    }

    public function getPostAjax($start, $limit) 
    {
        $mapper = spot()->mapper('Models\Post');
        $mapper->migrate();
        $check = $mapper->where(['status' => 'active'])
            ->order(['created_date' => 'DESC'])
            ->offset($start)
            ->limit($limit);
        return $check;
    }
}
