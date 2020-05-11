<?php

namespace MBozwood\Ipboard;

trait Members
{
    /**
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
     * Update an existing member with the details provided.
     *
     * @param integer $memberID The member ID of the member to update.
     * @param array $data Array of data (Allowed keys are name, email and password).
     *
     * @return mixed
     */
    public function updateMember($memberID, array $data = [])
    {
        return $this->postRequest('core/members/' . $memberID, $data);
    }
}
