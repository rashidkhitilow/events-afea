<?php
namespace App\Services;

use App\Repositories\EventRepository;

class EventService
{
    protected EventRepository $eventRepo;

    public function __construct(EventRepository $eventRepo)
    {
        $this->eventRepo = $eventRepo;
    }

    public function getAllEvents()
    {
        return $this->eventRepo->getAll();
    }

    public function getEventById($id)
    {
        return $this->eventRepo->getById($id);
    }

    public function createEvent(array $data)
    {
        return $this->eventRepo->create($data);
    }

    public function updateEvent($id, array $data)
    {
        return $this->eventRepo->update($id, $data);
    }

    public function deleteEvent($id)
    {
        return $this->eventRepo->delete($id);
    }
}
