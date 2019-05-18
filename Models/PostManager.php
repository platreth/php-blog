<?php

namespace Models;

use Models\Post;

class PostManager
{
    public function insert($post, $path)
    {
        $userMapper = spot()->mapper('Models\Post');
        $userMapper->migrate();
        $newPost = $userMapper->create([
            'author'     => $_SESSION['user']->id,
            'title'     => $post['title'],
            'image'     => $path,
            'subtitle'  => $post['subtitle'],
            'content'     => $post['content'],
          ]);
    }

    public function getMyPost()
    {
        $mapper = spot()->mapper('Models\Post');
        $mapper->migrate();
        $check = $mapper->where(['author' => $_SESSION['user']->id])
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

    public function getPost($id)
    {
        $mapper = spot()->mapper('Models\Post');
        $mapper->migrate();
        $check = $mapper->first(['id' => $id]);
        return $check;
    }

    public function updatePost($post, $id, $image)
    {
        $mapper = spot()->mapper('Models\Post');
        $entity = $mapper->first(['id' => $id]);
        $entity->title = $post['title'];
        $entity->subtitle = $post['subtitle'];
        $entity->content = $post['content'];
        $entity->image = $image;
        $entity->modified_date = new \DateTime();
        $mapper->update($entity);
    }

    public function deletePost($id)
    {
        $mapper = spot()->mapper('Models\Post');
        $entity = $mapper->first(['id' => $id]);
        $mapper->delete($entity);
    }
}
