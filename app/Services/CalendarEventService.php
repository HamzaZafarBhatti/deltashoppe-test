<?php

namespace App\Services;

use App\Models\CalendarEvent;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Spatie\GoogleCalendar\Event;

class CalendarEventService
{
    public function create($data)
    {
        $data['start_time'] = Carbon::parse($data['event_start']);
        $data['end_time'] =  Carbon::parse($data['event_end']);
        $data['creator_id'] = auth()->user()->id;
        $data['attendee1_id'] = $this->getOrCreateUserByEmail($data['attendee1_id'])->id;
        $data['attendee2_id'] = $this->getOrCreateUserByEmail($data['attendee2_id'])->id;
        $calendar_event = CalendarEvent::create($data);

        try {
            $event = new Event;

            $event->name = $data['title'];
            $event->description = $data['description'];
            $event->startDateTime = Carbon::parse($data['event_start']);
            $event->endDateTime = Carbon::parse($data['event_end']);
            $event->addAttendee(['email' => $data['attendee1_id']]);
            $event->addAttendee(['email' => $data['attendee2_id']]);
            // $event->addMeetLink(); // optionally add a google meet link to the event

            $event->save();
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
        }

        return $calendar_event;
    }

    public function update($data, $calendarEvent)
    {
        $data['start_time'] = Carbon::parse($data['event_start']);
        $data['end_time'] =  Carbon::parse($data['event_end']);
        $data['attendee1_id'] = $this->getOrCreateUserByEmail($data['attendee1_id'])->id;
        $data['attendee2_id'] = $this->getOrCreateUserByEmail($data['attendee2_id'])->id;
        $calendarEvent->update($data);

        try {
            $event = Event::find($calendarEvent->event_id);
            $event->name = $data['title'];
            $event->description = $data['description'];
            $event->startDateTime = Carbon::parse($data['event_start']);
            $event->endDateTime = Carbon::parse($data['event_end']);
            $event->addAttendee(['email' => $data['attendee1_id']]);
            $event->addAttendee(['email' => $data['attendee2_id']]);

            $event->save();
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
        }

        return $calendarEvent;
    }

    public function delete($calendarEvent)
    {
        try {
            //code...
            $event = Event::find($calendarEvent->event_id);
            $event->delete();
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
        }
        $calendarEvent->delete();
        return null;
    }

    private function getOrCreateUserByEmail($email)
    {
        $user = User::where('email', $email)->first();

        if (!$user) {
            $user = new User();
            $user->name = $email; // Use email as the name
            $user->email = $email;
            $user->password = bcrypt('password');
            $user->save();
        }

        return $user;
    }
}
