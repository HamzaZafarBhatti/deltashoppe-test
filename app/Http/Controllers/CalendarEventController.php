<?php

namespace App\Http\Controllers;

use App\Http\Requests\CalendarEvent\StoreRequest;
use App\Http\Requests\CalendarEvent\UpdateRequest;
use App\Models\CalendarEvent;
use App\Services\CalendarEventService;
use Illuminate\Http\Request;

class CalendarEventController extends Controller
{

    public function __construct(protected CalendarEventService $service)
    {
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $events = CalendarEvent::all();
        return view('admin.calendar-events.index', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.calendar-events.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        //
        $data = $request->validated();
        $this->service->create($data);
        return redirect()->route('calendar_events.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(CalendarEvent $calendarEvent)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CalendarEvent $calendarEvent)
    {
        //
        return view('admin.calendar-events.edit', compact('calendarEvent'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, CalendarEvent $calendarEvent)
    {
        //
        $data = $request->validated();
        $this->service->update($data, $calendarEvent);
        return redirect()->route('calendar_events.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CalendarEvent $calendarEvent)
    {
        //
        $this->service->delete($calendarEvent);
        return redirect()->route('calendar_events.index');
    }
}
