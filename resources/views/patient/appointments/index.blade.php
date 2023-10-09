@extends('admin.layouts.admin-master')

@section('title', 'Smile Pro HQ | Set Appointment')

@push('style')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

    <!-- Include DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">

@endpush

@section('content')
    <h1 class="my-4 text-primary">My Appointments</h1>
    <div class="row">
        <table id="appointments-table" class="table table-striped table-bordered w-100">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Date/Time</th>
                    <th>Type</th>
                    <th>Doctor</th>
                    <th>Notes</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
        </table>
    </div>

    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

    <!-- Include DataTables JS -->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/6.0.0/bootbox.min.js" integrity="sha512-oVbWSv2O4y1UzvExJMHaHcaib4wsBMS5tEP3/YkMP6GmkwRJAa79Jwsv+Y/w7w2Vb/98/Xhvck10LyJweB8Jsw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $(document).ready(function() {
            $('#appointments-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('patients.appointments.index') }}",
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'date', name: 'date' },
                    { data: 'type', name: 'type' },
                    { data: 'doctor', name: 'doctor' },
                    { data: 'notes', name: 'notes' },
                    { data: 'status', name: 'status' },
                    {
                        data: null,
                        render: function(data, type, row) {
                            // Add "View" and "Delete" buttons in the Action column
                            if(row.status != 'Cancelled'){
                                return '<button class="btn btn-warning cancel-btn" data-id="' + data.id + '">Cancel Appointment</button> '
                            }
                            else{
                                return '';
                            }
                        },
                        orderable: false, // Disable sorting on this column
                        searchable: false // Disable searching on this column
                    }
                ]
            });
        });
    </script>

    <script>
        // Handle the Cancel button click event
        $(document).on('click', '.cancel-btn', function () {
            // Get the data from the row
            var row = $(this).closest('tr');
            var id = row.find('td:eq(0)').text();
            var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            // Display a bootbox confirmation dialog
            bootbox.confirm({
                message: 'Are you sure you want to cancel this appointment: ' + id + '?',
                buttons: {
                    confirm: {
                        label: 'Yes',
                        className: 'btn-danger'
                    },
                    cancel: {
                        label: 'No',
                        className: 'btn-secondary'
                    }
                },
                callback: function (result) {
                    if (result) {
                        var url = "{{ route('patients.appointments.cancel', ['id' => ':id']) }}";
                        url = url.replace(':id', id);

                        // Send an AJAX request to cancel the appointment
                        $.ajax({
                            type: 'PUT',
                            url: url,
                            headers: {
                                'X-CSRF-TOKEN': csrfToken // Include the CSRF token in the headers
                            },
                            success: function (response) {
                                // Check if the cancellation was successful
                                if (response && response.message === 'Appointment cancelled successfully') {
                                    // Update the row to display "Cancelled" status
                                    row.find('td:eq(5)').text('Cancelled');
                                    row.find('td:eq(6)').text('');
                                }
                            },
                            error: function (error) {
                                // Handle any errors (e.g., display an error message)
                                console.error(error);
                            }
                        });
                    }
                }
            });
        });

    </script>
@endpush
