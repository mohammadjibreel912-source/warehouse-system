@extends('admim.layouts.app')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">Edit Spot</h4>

    <div class="card mb-4 shadow-sm">
        <div class="card-body">
            <form action="{{ route('spots.update', $spot->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Name</label>
                        <input type="text" name="name" class="form-control" value="{{ $spot->name }}" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Address</label>
                        <input type="text" name="address" class="form-control" value="{{ $spot->address }}" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control" rows="3">{{ $spot->description }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Images (multiple allowed)</label>
                    <input type="file" name="images[]" class="form-control" multiple>
                    @if($spot->images)
                        <div class="mt-2 d-flex flex-wrap gap-1">
                            @foreach(json_decode($spot->images) as $img)
                                <img src="{{ asset('storage/'.$img) }}" width="80" class="border rounded">
                            @endforeach
                        </div>
                    @endif
                </div>

                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Map Link</label>
                        <input type="url" name="map_link" class="form-control" value="{{ $spot->map_link }}">
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">Open Time</label>
                        <input type="time" name="open_time" class="form-control" value="{{ $spot->open_time }}" required>
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">Close Time</label>
                        <input type="time" name="close_time" class="form-control" value="{{ $spot->close_time }}" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Contact Numbers</label>
                    @php $contacts = json_decode($spot->contact_numbers); @endphp
                    <div class="d-flex gap-2">
                        <input type="text" name="contact_numbers[]" class="form-control" placeholder="Number 1" value="{{ $contacts[0] ?? '' }}">
                        <input type="text" name="contact_numbers[]" class="form-control" placeholder="Number 2" value="{{ $contacts[1] ?? '' }}">
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Ticket Price (JOD)</label>
                    <input type="number" step="0.01" name="ticket_price" class="form-control" value="{{ $spot->ticket_price }}" required>
                </div>

                <button type="submit" class="btn btn-success">
                    <i class="bx bx-save me-1"></i> Update
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
