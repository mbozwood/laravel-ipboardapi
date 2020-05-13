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
     * @param array $data
     *
     * @return mixed
     */
    public function createPost(array $data)
    {
        return $this->postRequest('forums/posts', $data);
    }

    /**
     * Edit a post
     *
     * @param integer $post_id
     * @param array $data
     *
     * @return mixed
     */
    public function updatePost($post_id, array $data)
    {
        return $this->postRequest('forums/posts/' . $post_id, $data);
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
