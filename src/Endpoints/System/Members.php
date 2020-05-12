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
     * @param string $name
     * @param string $email
     * @param array $rawProperties
     * @param int $group
     * @param string $password
     * @param int $validated
     *
     * @return mixed
     */
    public function createMember($name, $email, $rawProperties = [], $group = 3, $password = 'this-is-not-actually-required2020!', $validated = 1)
    {
        return $this->postRequest('core/members', compact('name', 'email', 'password', 'group', 'rawProperties', 'validated'));
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
