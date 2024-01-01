@extends('admin.layout.app')

@section('content')
<div class="row">
    <div class="col-12 mt-4">
        <div class="card">
            <div class="card-header">
                <h3>Edit Event</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('calendar_events.update', $calendarEvent->id) }}" method="post">
                    @csrf
                    @method('patch')
                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" name="title" id="title" class="form-control" value="{{$calendarEvent->title}}">
                        @error('title')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea name="description" id="description" cols="30" rows="3" class="form-control">{{$calendarEvent->description}}</textarea>
                        @error('description')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Start Time</label>
                                <input type="datetime-local" class="form-control" name="event_start" value="{{$calendarEvent->start_time}}">
                                @error('event_start')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>End Time</label>
                                <input type="datetime-local" class="form-control" name="event_end" value="{{$calendarEvent->end_time}}">
                                @error('event_end')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Attendee 1</label>
                                <input type="email" name="attendee1_id" id="attendee1_id" class="form-control" value="{{$calendarEvent->attendee1->email}}">
                                @error('attendee1_id')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Attendee 2</label>
                                <input type="email" name="attendee2_id" id="attendee2_id" class="form-control" value="{{$calendarEvent->attendee2->email}}">
                                @error('attendee2_id')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <button class="btn btn-primary" type="submit">Update Event</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection