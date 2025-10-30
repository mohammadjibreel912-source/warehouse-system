@extends('admim.index')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">All Spots</h4>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="mb-4">
        <a href="{{ route('spots.create') }}" class="btn btn-primary">
            <i class="bx bx-plus"></i> Add New Spot
        </a>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <div class="table-responsive text-nowrap">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Name</th>
                            <th>Address</th>
                            <th>Ticket Price</th>
                            <th>Payment QR</th>
                            <th>Images</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach($spots as $spot)
                        <tr>
                            <td>{{ $spot->name }}</td>
                            <td>{{ $spot->address }}</td>
                            <td>{{ number_format($spot->ticket_price, 2) }} JOD</td>
                            <td>
                                @if($spot->qr_code_image)
                                    <a href="{{ asset('storage/' . $spot->qr_code_image) }}" target="_blank" class="btn btn-sm btn-info">
                                        <i class="bx bx-qrcode"></i> Show QR
                                    </a>
                                @endif
                            </td>
                           <td>
    @php
        $images = is_array($spot->images) ? $spot->images : json_decode($spot->images, true);
    @endphp

    @if($images)
        <div class="d-flex flex-wrap gap-2">
            @foreach($images as $index => $img)
                <div class="position-relative">
                    <img src="{{ asset('storage/'.$img) }}" width="50" class="border rounded">
                    <a href="{{ route('spots.show360', [$spot->id, $index]) }}" target="_blank" class="position-absolute top-0 end-0 btn btn-sm btn-primary">
                        <i class="bx bx-rotate-right"></i>
                    </a>
                </div>
            @endforeach
        </div>
    @endif
</td>

                            <td>
                                <a href="{{ route('spots.edit', $spot->id) }}" class="btn btn-sm btn-warning">
                                    <i class="bx bx-edit"></i> Edit
                                </a>
                                <form action="{{ route('spots.destroy', $spot->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
                                        <i class="bx bx-trash"></i> Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                {{ $spots->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
</div>
@endsection
