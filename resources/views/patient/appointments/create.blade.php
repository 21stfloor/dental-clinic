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
                            <label for="time" class="form-label">Choose a time slot:</label>
                            <input type="date" name="time" class="form-control" hidden>
                        </div>

                        <div class="mb-3">
                            <label for="type" class="form-label">Type</label>
                            <select class="form-select" aria-label="Default select example" name="type" id="type"
                                form="addAppointmentForm" required>
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

                        <input type="hidden" id="selectedDoctor" name="doctor_id">
                        <input type="hidden" id="selectedSchedule" name="schedule_id">
                    </form>
                </div>
            </div>
        </div>

        <div id="doctorContainer" class="col-4">
            
        </div>

    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            let setTimeConfig = {
                enableTime: true,
                inline: true,
                minDate: "today",
                onChange: function(selectedDates, dateStr, instance) {
                    
                    $.ajax({
                        type: "GET",
                        url: "/api/doctors/schedule",
                        data: { date: dateStr },
                        
                        success: function(response) {
                            console.log(response);

                            $("#doctorContainer").empty();

                            if(response.length > 0){
                                // Handle the response here
                                // For example, you can display the doctors in a div with id 'result'
                                response.forEach(function(doctor) {
                                    let doctorLayout = getDoctorLayout(doctor);
                                    $('#doctorContainer').append(doctorLayout);
                                });
                            }
                            else{
                                $("#doctorContainer").append(`<h1>There are no available dentist on the selected day.<br>Please select other day.</h1>`);
                            }
                            // $('#doctorContainer').html('<pre>' + JSON.stringify(response, null, 2) + '</pre>');
                        },
                        error: function(error) {
                            console.error("AJAX error:", error);
                        }
                    });
                }
            }
            $('input[type="date"]').flatpickr(setTimeConfig)
        });

        function getDoctorLayout(doctor){
            return `<div class="row">
                <div class="card">
                    <div class="card-body shadow">
                        <div class="d-flex justify-content-center align-items-center mb-3">
                            <img src="${doctor.avatar}" alt="avatar"
                                class="img-fluid rounded-circle avatar"/>
                        </div>
                        <ul class="list-group list-group-flush mb-3">
                            <li class="list-group-item">Name:
                                Dr. ${doctor.first_name} ${doctor.last_name}
                            </li>
                            <li class="list-group-item">Contact Number: ${doctor.contact_number}</li>
                            <li class="list-group-item">Email: ${doctor.email}</li>
                        </ul>

                        <div class="d-grid">
                            <button type="button" data-schedule="${doctor.schedule_id}" data-doctor="${doctor.id}" class="btn btn-primary doctorSelect"><i
                                    class="bi bi-bookmark me-1"></i>Select Doctor</a></button>
                        </div>
                    </div>
                </div>
            </div>`;
        }
    </script>

    <script>
        $(document).ready(function() {

            $("#doctorContainer").on("click", ".doctorSelect", function(event) {
                // Prevent the default form submission
                event.preventDefault();

                // Get the form associated with the clicked button
                var form = $("#addAppointmentForm");//$(this).closest("form");
                // Get the FormData object for the form
                var formData = new FormData(form[0]);
                // Get the form action URL
                var actionUrl = form.attr("action");

                // Your custom logic goes here
                // For example, you can perform AJAX form submission or any other action
                let doctorId = $(this).data('doctor');
                $("#selectedDoctor").val(doctorId);
                let scheduleId = $(this).data('schedule');
                $("#selectedSchedule").val(scheduleId);
                console.log(`doctor = ${doctorId}`);

                form.submit();
            });

        });
    </script>
@endpush
