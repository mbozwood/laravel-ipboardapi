<?php

namespace MBozwood\IPBoardApi\Endpoints\Calendar;

trait Events
{
    /**
     * Get list of events
     *
     * @param array $query_params
     * @return mixed
     */
    public function getEvents($query_params = [])
    {
        return $this->getRequest('calendar/events', $query_params);
    }

    /**
     * View information about a specific event
     *
     * @param integer $event_id
     * @return mixed
     */
    public function getEvent($event_id)
    {
        return $this->getRequest('calendar/events/' . $event_id);
    }

    /**
     * Create an event
     *
     * @param array $data
     *
     * @return mixed
     */
    public function createEvent($data)
    {
        return $this->postRequest('calendar/events', $data);
    }

    /**
     * Edit an event
     *
     * @param integer $event_id
     * @param array $data
     *
     * @return mixed
     */
    public function updateEvent($event_id, $data)
    {
        return $this->postRequest('calendar/events/' . $event_id, $data);
    }

    /**
     * RSVP a member to an event
     *
     * @param integer $event_id
     * @param integer $member_id
     * @param integer $response
     *
     * @return mixed
     */
    public function putRsvp($event_id, $member_id, $response = 1)
    {
        return $this->putRequest('calendar/events/' . $event_id . '/rsvps/' . $member_id, compact('response'));
    }

    /**
     * Remove a member from RSVP list
     *
     * @param integer $event_id
     * @param integer $member_id
     *
     * @return mixed
     */
    public function removeRsvp($event_id, $member_id)
    {
        return $this->deleteRequest('calendar/events/' . $event_id . '/rsvps/' . $member_id);
    }

    /**
     * Deletes an event
     *
     * @param integer $event_id
     * @return mixed
     */
    public function deleteEvent($event_id)
    {
        return $this->deleteRequest('calendar/events/' . $event_id);
    }
}
