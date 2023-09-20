@extends('admin.layouts.admin-master')

@section('title', 'Smile Pro HQ | Set Appointment')

@section('content')
    <h1 class="my-4 text-primary">Book Appointment</h1>

    @if ($errors->has('time') || $errors->has('type'))
        <div class="alert alert-danger">
            @if ($errors->has('time'))
                {{ $errors->first('time') }}
            @endif
            @if ($errors->has('type'))
                {{ $errors->first('type') }}
            @endif
        </div>
    @endif

    <a href="{{ route('patients.appointments.index') }}" class="btn btn-primary mb-3" role="button"><i
            class="bi bi-caret-left me-1"></i>Back</a>

    <div class="row">
        <div class="col-8">
            <div class="card">
                <div class="card-body shadow">
                    <form action="{{ route('patients.appointments.store') }}" method="POST" id="addAppointmentForm">
                        @csrf
                        <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" name="title" id="title" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label for="time" class="form-label">Choose a time slot:</label>
                            <input type="date" name="time" class="form-control" hidden>
                        </div>

                        <div class="mb-3">
                            <label for="type" class="form-label">Type</label>
                            <select class="form-select" aria-label="Default select example" name="type" id="type"
                                form="addAppointmentForm">
                                <option selected>Select a service type</option>
                                <option value="tooth-extraction">Tooth Extraction</option>
                                <option value="orthondontics">Orthodontics</option>
                                <option value="veeners">Veeners</option>
                                <option value="whitening-dental">Whitening Dental</option>
                                <option value="filling">Filling</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="floatingTextarea" class="form-label">Notes</label>
                            <textarea class="form-control" placeholder="Leave a note here" id="floatingTextarea" style="height: 100px"
                                name="notes"></textarea>
                        </div>

                        <input type="hidden" name="schedule_id" value="{{ $schedule->id }}">
                        <input type="hidden" name="doctor_id" value="{{ $schedule->doctor_id }}">
                    </form>
                </div>
            </div>
        </div>

        <div class="col-4">
            <div class="card">
                <div class="card-body shadow">
                    <div class="d-flex justify-content-center align-items-center mb-3">
                        <img src="{{ $schedule->doctor->user->avatar }}" alt="avatar"
                            class="img-fluid rounded-circle avatar">
                    </div>
                    <ul class="list-group list-group-flush mb-3">
                        <li class="list-group-item">Name:
                            Dr. {{ $schedule->doctor->first_name . ' ' . $schedule->doctor->last_name }}
                        </li>
                        <li class="list-group-item">Contact Number: {{ $schedule->doctor->contact_number }}</li>
                        <li class="list-group-item">Email: {{ $schedule->doctor->email }}</li>
                    </ul>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary" form="addAppointmentForm"><i
                                class="bi bi-bookmark me-1"></i>Book
                            Appointment</a></button>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            let setTimeConfig = {
                enableTime: true,
                inline: true,
                minDate: "today"
            }
            $('input[type="date"]').flatpickr(setTimeConfig)
        });
    </script>
@endpush
