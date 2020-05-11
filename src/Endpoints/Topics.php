<?php

namespace MBozwood\Ipboard;

trait Topics
{
    /**
     * Fetch all announcement topics
     *
     * @param int $forum_id
     * @param string $sort_by
     * @param string $sort_dir
     * @return mixed
     */
    public function getAnnouncements($forum_id = 1, $sort_by = 'date', $sort_dir = 'desc')
    {
        $searchCriteria = [
            'forums' => $forum_id,
            'sortBy' => $sort_by,
            'sortDir' => $sort_dir
        ];

        return $this->getRequest('forums/topics', $searchCriteria);
    }
}
