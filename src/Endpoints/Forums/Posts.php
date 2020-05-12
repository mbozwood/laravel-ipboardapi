<?php

namespace MBozwood\IPBoardApi;

trait Posts
{
    /**
     * Get list of posts
     *
     * @param array $query_params
     * @return mixed
     */
    public function getPosts($query_params = [])
    {
        return $this->getRequest('forums/posts', $query_params);
    }

    /**
     * View information about a specific post
     *
     * @param integer $post_id
     * @return mixed
     */
    public function getPost($post_id)
    {
        return $this->getRequest('forums/posts/' . $post_id);
    }

    /**
     * Create a post
     *
     * @param integer $topic
     * @param integer $author
     * @param string $post
     * @return mixed
     */
    public function createPost($topic, $author, $post)
    {
        return $this->postRequest('forums/posts', compact('topic','author', 'post'));
    }

    /**
     * Edit a post
     *
     * @param integer $post_id
     * @param integer $author
     * @param string $post
     * @return mixed
     */
    public function updatePost($post_id, $author, $post)
    {
        return $this->postRequest('forums/posts/' . $post_id, compact('author', 'post'));
    }

    /**
     * Deletes a post
     *
     * @param integer $post_id
     * @return mixed
     */
    public function deletePost($post_id)
    {
        return $this->deleteRequest('forums/posts/' . $post_id);
    }
}
