<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\EventService;
use Illuminate\Http\Request;

class EventController extends Controller
{
    protected EventService $userEventService;

    public function __construct(EventService $userEventService)
    {
        $this->userEventService = $userEventService;
    }

    public function index()
    {
        return $this->userEventService->getAllEvents();
    }

    public function store(Request $request)
    {
        return $this->userEventService->createEvent($request->all());
    }

    public function show($id)
    {
        return $this->userEventService->getEventById($id);
    }

    public function update(Request $request, $id)
    {
        return $this->userEventService->updateEvent($id, $request->all());
    }

    public function destroy($id)
    {
        return $this->userEventService->deleteEvent($id);
    }
}
