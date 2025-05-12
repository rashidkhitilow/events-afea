<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\UserEventService;
use Illuminate\Http\Request;

class UserEventController extends Controller
{
    protected UserEventService $userEventService;

    public function __construct(UserEventService $userEventService)
    {
        $this->userEventService = $userEventService;
    }

    public function index($userEventId)
    {
        return $this->userEventService->getUserEventsByEventId($userEventId);
    }

    public function store(Request $request)
    {
        return $this->userEventService->createUserEvent($request->all());
    }

    public function update(Request $request, $id)
    {
        return $this->userEventService->updateUserEvent($id, $request->all());
    }

    public function destroy($id)
    {
        return $this->userEventService->deleteUserEvent($id);
    }
}
