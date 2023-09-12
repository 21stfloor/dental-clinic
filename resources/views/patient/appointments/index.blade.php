@extends('admin.layouts.admin-master')

@section('title', 'Pulp Dental Clinic | Set Appointment')

@section('content')
    <h1 class="my-4 text-primary">Available Dentists</h1>
    <div class="row row-cols-1 row-cols-md-4 g-4">
        @foreach ($schedules as $schedule)
            <div class="col">
                <div class="card h-100">
                    <div class="card-body shadow">
                        <div class="d-flex justify-content-center align-items-center mb-3">
                            @if ($schedule->doctor->user->avatar)
                                <img src="{{ $schedule->doctor->user->avatar }}" alt=""
                                    class="img-fluid rounded-circle avatar">
                            @else
                                <img src="{{ asset('images/avatar.jpg') }}" alt=""
                                    class="img-fluid rounded-circle avatar">
                            @endif
                        </div>
                        <ul class="list-group list-group-flush mb-3">
                            <li class="list-group-item">
                                Dr. {{ $schedule->doctor->first_name . ' ' . $schedule->doctor->last_name }}
                            </li>
                            <li class="list-group-item">
                                Availability: {{ $schedule->formatted_date }}
                            </li>
                        </ul>
                        <div class="d-grid">
                            <a href="{{ route('patients.appointments.create', $schedule) }}" class="btn btn-primary"
                                role="button"><i class="bi bi-bookmark me-1"></i>Book
                                Appointment</a>
                        </div>

                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
