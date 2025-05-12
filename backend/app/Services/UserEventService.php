<?php
namespace App\Services;

use App\Repositories\UserEventRepository;

class UserEventService
{
    protected UserEventRepository $userEventRepo;

    public function __construct(UserEventRepository $userEventRepo)
    {
        $this->userEventRepo = $userEventRepo;
    }

    public function getAllUserEvents()
    {
        return $this->userEventRepo->getAll();
    }

    public function getUserEventsByEventId($eventId)
    {
        return $this->userEventRepo->getByEventId($eventId);
    }
    public function getUserEventsByUserId($userId)
    {
        return $this->userEventRepo->getByUserId($userId);
    }

    public function createUserEvent(array $data)
    {
        return $this->userEventRepo->create($data);
    }

    public function updateUserEvent($id, array $data)
    {
        return $this->userEventRepo->update($id, $data);
    }

    public function deleteUserEvent($id)
    {
        return $this->userEventRepo->delete($id);
    }
}
