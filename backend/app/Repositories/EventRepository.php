<?php
namespace App\Repositories;

use App\Models\Event;
use Illuminate\Support\Facades\Log;

class EventRepository
{
    public function getAll(): \Illuminate\Database\Eloquent\Collection
    {
        // get all event if available seats is greater than 0 and status is not booked and get all available seat numbers
        return Event::where('available_seats', '>', 0)
        ->with('user_event')
        ->get();
    }

    public function getById($id)
    {
            return Event::where('available_seats', '>', 0)
                ->where('id', $id)
                ->with('user_event')
                ->get()
                ->map(function ($event) {
                    $takenSeats = $event->user_event->pluck('seat_number')->toArray();
                    Log::info('takenSeats', ['takenSeats' => $takenSeats]);

                    $allSeats = range(1, $event->total_seats);
                    Log::info('allSeats', ['allSeats' => $allSeats]);

                    $availableSeats = array_values(array_diff($allSeats, $takenSeats));
                    $eventArray = $event->toArray();
                    $eventArray['available_seat_numbers'] = $availableSeats;

                    return $eventArray;
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
