<?php

namespace MBozwood\IPBoardApi;

trait Members
{
    /**
     * @param array $query_params
     *
     * @return mixed
     */
    public function getMembers($query_params = [])
    {
        return $this->getRequest('core/members', $query_params);
    }

    /**
     * Get a specific member based on ID
     * @param integer $id
     *
     * @return mixed
     */
    public function getMember($id)
    {
        return $this->getRequest('core/members/' . $id);
    }

    /**
     * Create a member with the details provided
     *
     * @param $data
     * @return mixed
     */
    public function createMember($data)
    {
        return $this->postRequest('core/members', $data);
    }

    /**
     * Update an existing member with the details provided
     *
     * @param integer $memberID The member ID of the member to update
     * @param array $data
     *
     * @return mixed
     */
    public function updateMember($memberID, array $data = [])
    {
        return $this->postRequest('core/members/' . $memberID, $data);
    }

    /**
     * Delete an existing member with the details provided.
     *
     * @param integer $memberID The member ID of the member to delete
     *
     * @return mixed
     */
    public function deleteMember($memberID)
    {
        return $this->deleteRequest('core/members/' . $memberID);
    }
}
