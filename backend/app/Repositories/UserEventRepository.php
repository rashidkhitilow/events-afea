<?php
namespace App\Repositories;

use App\Models\Event;
use App\Models\UserEvent;

class UserEventRepository
{
    public function getAll()
    {
        return UserEvent::all();
    }

    public function getByEventId($eventId)
    {
        return UserEvent::where('event_id', $eventId)->get();
    }
    public function getByUserId($eventId)
    {
        return UserEvent::where('user_id', $eventId)->get();
    }

    public function create(array $data)
    {
        // when user crates event it should be created with event id and user id and then available_seats should be decremented
        // also check if available_seats is greater than 0 and prevent same seat number for same event
        $event = Event::find($data['event_id']);
        if ($event->available_seats > 0) {

            $existingSeat = UserEvent::where('event_id', $data['event_id'])
                ->where('seat_number', $data['seat_number'])
                ->first();

            if($existingSeat) {
                throw new \Exception('Seat number already taken for this event');
            }

            if($event->total_seats < $data['seat_number']) {
                throw new \Exception('Seat number exceeds total seats');
            }


            $event->available_seats--;
            if($event->available_seats == 0) {
                $event->status = 'booked';
            }
            $event->save();
            return UserEvent::create([
                'event_id' => $data['event_id'],
                'user_id' => 1,
                'seat_number' => $data['seat_number']
            ]);



        } else {
            throw new \Exception('No available seats');
        }

    }

    public function update($id, array $data)
    {
        $userEvent = UserEvent::findOrFail($id);
        $userEvent->update($data);
        return $userEvent;
    }

    public function delete($id)
    {
        UserEvent::destroy($id);
    }
}
