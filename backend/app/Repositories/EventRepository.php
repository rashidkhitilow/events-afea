<?php
namespace App\Repositories;

use App\Models\Event;

class EventRepository
{
    public function getAll(): \Illuminate\Database\Eloquent\Collection
    {
        // get all event if available seats is greater than 0 and status is not booked and get all available seat numbers
        return Event::where('available_seats', '>', 0)
            ->where('status', '!=', 'booked')
            ->with('user_event')
            ->get()
            ->map(function ($event) {
                $event->available_seat_numbers = range(1, $event->available_seats);
                return $event;
            });
    }

    public function getById($id)
    {
            return Event::where('available_seats', '>', 0)
                ->where('id', $id)
                ->with('user_event')
                ->get()
                ->map(function ($event) {
                    $event->available_seat_numbers = range(1, $event->available_seats);
                    return $event;
                });
    }

    public function create(array $data)
    {
       if (isset($data['total_seats']) && $data['total_seats'] > 0) {
            return Event::create($data);
        } else {
            throw new \Exception('Available seats must be greater than 0');
        }

    }

    public function update($id, array $data)
    {
        $event = Event::findOrFail($id);
        $event->update($data);
        return $event;
    }

    public function delete($id)
    {
        Event::destroy($id);
    }
}
