@extends('admim.layouts.app')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">Notifications</h4>


    <div class="card shadow-sm">
        <div class="card-body">
            @if($notifications->isEmpty())
                <p>No notifications found.</p>
            @else
                <ul class="list-group">
                    @foreach($notifications as $notification)
                        <li class="list-group-item d-flex justify-content-between align-items-center
                            {{ $notification->read_at ? 'bg-light text-muted' : 'bg-white' }}">
                            <div>
                                <strong>{{ ucfirst($notification->type) }}</strong><br>
                                {{ $notification->message }}<br>
                                <small class="text-muted">{{ $notification->created_at->diffForHumans() }}</small>
                            </div>
                            @if(!$notification->read_at)
                                <form action="{{ route('notifications.markAsRead', $notification) }}" method="POST">
                                    @csrf
                                    <button class="btn btn-sm btn-primary">Mark as Read</button>
                                </form>
                            @else
                                <span class="badge bg-success">Read</span>
                            @endif
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
</div>
@endsection
