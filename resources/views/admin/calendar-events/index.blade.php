@extends('admin.layout.app')

@section('content')
<div class="row">
    <div class="col-12 mt-4">
        <div class="card">
            <div class="card-header">
                <h3>Events</h3>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Event Title</th>
                            <th>Description</th>
                            <th>Created By</th>
                            <th>Attendee 1</th>
                            <th>Attendee 2</th>
                            <th>Event Duration</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($events as $event)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $event->title }}</td>
                            <td>{{ $event->description }}</td>
                            <td>{{ $event->creator->name }}</td>
                            <td>{{ $event->attendee1->name }}</td>
                            <td>{{ $event->attendee2->name }}</td>
                            <td>{{ $event->start_time->format('M d, Y H:i A') }} - {{ $event->end_time->format('M d, Y H:i A') }}</td>
                            <td>
                                <div class="d-flex" style="gap: 10px">
                                    <a type="button" href="{{ route('calendar_events.edit', $event->id) }}" class="btn btn-info">Edit</a>
                                    <a type="button" href="{{ route('calendar_events.destroy', $event->id) }}" class="btn btn-danger" onclick="event.preventDefault(); document.getElementById('delete{{$event->id}}').submit()">Delete</a>
                                    <form action="{{ route('calendar_events.destroy', $event->id) }}" id="delete{{$event->id}}" method="post">
                                        @csrf
                                        @method('delete')
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection