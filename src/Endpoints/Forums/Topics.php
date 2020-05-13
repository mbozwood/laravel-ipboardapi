<?php

namespace MBozwood\IPBoardApi\Endpoints\Forums;

trait Topics
{
    /**
     * Get list of topics
     *
     * @param array $query_params
     * @return mixed
     */
    public function getTopics($query_params = [])
    {
        return $this->getRequest('forums/topics', $query_params);
    }

    /**
     * View information about a specific post
     *
     * @param integer $topic_id
     * @return mixed
     */
    public function getTopic($topic_id)
    {
        return $this->getRequest('forums/topics/' . $topic_id);
    }

    /**
     * Get posts in a topic
     *
     * @param integer $topic_id
     * @param array $query_params
     * @return mixed
     */
    public function getTopicPosts($topic_id, $query_params = [])
    {
        return $this->getRequest('forums/topics/' . $topic_id . '/posts', $query_params);
    }

    /**
     * Create a post
     *
     * @param array $data
     *
     * @return mixed
     */
    public function createTopic(array $data)
    {
        return $this->postRequest('forums/topics', $data);
    }

    /**
     * Edit a post
     *
     * @param integer $topic_id
     * @param array $data
     *
     * @return mixed
     */
    public function updateTopic($topic_id, array $data)
    {
        return $this->postRequest('forums/topics/' . $topic_id, $data);
    }

    /**
     * Deletes a post
     *
     * @param integer $topic_id
     * @return mixed
     */
    public function deleteTopic($topic_id)
    {
        return $this->deleteRequest('forums/topics/' . $topic_id);
    }
}
