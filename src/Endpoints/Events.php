<?php

namespace MBozwood\Ipboard;

trait Events
{
    /**
     * Fetch all upcoming events
     *
     * @param $calendar_id
     * @return mixed
     */
    public function getEvents($calendar_id = 1)
    {
        $searchCriteria = [
            'rangeStart' => date('Y-m-d'),
            'calendars' => $calendar_id,
            'sortBy' => 'start',
        ];

        return $this->getRequest('calendar/events', $searchCriteria);
    }

    /**
     * Create Event
     *
     * @param $calender
     * @param $author
     * @param $title
     * @param $description - html
     * @param $start
     * @param $end
     * @return mixed
     */
    public function createEvent($calender, $author, $title, $description, $start, $end)
    {
        return $this->postRequest('calendar/events', compact('calender', 'title', 'description', 'start', 'end'));
    }

    /**
     * Update Event
     *
     * @param $event_id
     * @param $calender
     * @param $author
     * @param $title
     * @param $description - html
     * @param $start
     * @param $end
     * @return mixed
     */
    public function updateEvent($event_id, $calender, $author, $title, $description, $start, $end)
    {
        return $this->postRequest('calendar/events/' . $event_id, compact('calender', 'title', 'description', 'start', 'end'));
    }

    /**
     * Delete Event
     *
     * @param $event_id
     * @return mixed
     */
    public function deleteEvent($event_id)
    {
        return $this->deleteRequest('calendar/events/' . $event_id);
    }
}
