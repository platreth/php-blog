<?php

namespace Models;

use Models\Comment;

class CommentManager
{
    public function createComment($id_post, $id_user, $content)
    {
        $CommentMapper = spot()->mapper('Models\Comment');
        $CommentMapper->migrate();
        $newComment = $CommentMapper->create([
            'author'     => $id_user,
            'id_post'     => $id_post,
            'content'     => $content,
          ]);
    }

    public function getWaitingValidationComment()
    {
        $mapper = spot()->mapper('Models\Comment');
        $mapper->migrate();
        $check = $mapper->where(['status' => '0']);
        return $check;
    }

    public function approveComment($id)
    {
        $mapper = spot()->mapper('Models\Comment');
        $entity = $mapper->first(['id' => $id]);
        $entity->status = '1';
        $mapper->update($entity);
    }

    public function deleteComment($id)
    {
        $mapper = spot()->mapper('Models\Comment');
        $entity = $mapper->first(['id' => $id]);
        $mapper->delete($entity);
    }

    public function getComment($id_post)
    {
        $mapper = spot()->mapper('Models\Comment');
        $mapper->migrate();
        $check = $mapper->where(['id_post' => $id_post, 'status' => '1']);
        return $check;
    }
}
