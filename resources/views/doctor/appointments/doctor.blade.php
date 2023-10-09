@extends('admin.layouts.admin-master')

@section('title', 'Smile Pro HQ | Set Appointment')

@push('style')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

    <!-- Include DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">

@endpush

@section('content')
    <h1 class="my-4 text-primary">My Patient Appointments</h1>
    <div class="row">
        <table id="appointments-table" class="table table-striped table-bordered w-100">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Date</th>
                    <th>Type</th>
                    <th>Patient</th>
                    <th>Contact Number</th>
                    <th>Notes</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
        </table>
    </div>

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <input name="doctor" value="{{$doctor}}" hidden>
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
                ajax: "{{ route('patients.appointments.doctor') }}",
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'date', name: 'date' },
                    { data: 'type', name: 'type' },
                    { data: 'patient', name: 'patient' },
                    { data: 'contact_number', name: 'contact_number' },
                    { data: 'notes', name: 'notes' },
                    { data: 'status', name: 'status' },
                    {
                        data: 'id', // Assuming 'id' is the column containing appointment IDs
                        render: function(data, type, row) {
                            // Define the select options for different appointment statuses
                            var statusOptions = [
                                { value: 'Pending', label: 'Pending' },
                                { value: 'Accepted', label: 'Accepted' },
                                { value: 'Ongoing', label: 'Ongoing' },
                                { value: 'Done', label: 'Done' },
                                { value: 'Cancel', label: 'Cancel' }
                            ];

                            // Create a select dropdown with options
                            var selectHtml = '<select class="appointment-status-select" data-id="' + data + '">';

                            for (var i = 0; i < statusOptions.length; i++) {
                                var option = statusOptions[i];
                                var selected = option.value === row.status ? 'selected' : '';
                                selectHtml += '<option value="' + option.value + '" ' + selected + '>' + option.label + '</option>';
                            }

                            selectHtml += '</select>';

                            return selectHtml;
                        },
                        orderable: false, // Disable sorting on this column
                        searchable: false // Disable searching on this column
                    }

                ]
            });
        });
    </script>

    <script>
        $(document).on('change', '.appointment-status-select', function () {
            var row = $(this).closest('tr');
            var id = $(this).data('id');
            var newStatus = $(this).val();
            var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            
            
            bootbox.prompt('Are you sure you want to change the appointment status(Input a note)?',
            function(result) {
                if(result){
                        // Send an AJAX request to update the appointment status
                    $.ajax({
                        type: 'PUT',
                        url: "{{ route('doctors.appointments.update', ['id' => ':id']) }}".replace(':id', id),
                        headers: {
                            'X-CSRF-TOKEN': csrfToken
                        },
                        data: {
                            status: newStatus,
                            notes: result
                        },
                        success: function (response) {
                            if (response && response.message === 'Appointment status updated successfully') {
                                // Update the row to display the new status
                                row.find('td:eq(6)').text(newStatus);
                                row.find('td:eq(5)').text(result);
                                var recipient = row.find('td:eq(4)').text();

                                var patient_name = row.find('td:eq(3)').text();
                                // var doctor = row.find('td:eq(3)').text();
                                var doctor = $('input[name="doctor"]').val();
                                var date = row.find('td:eq(1)').text();
                                var note = row.find('td:eq(5)').text();

                                var message = `Good day ${patient_name},\nThis is Smile Pro HQ\nWe would like to update you on the status of your appointment on:${date},\n
                                Dr.${doctor} updated the status to ${newStatus}.\n
                                Doctor's note:${note}`;

                                console.log(recipient);
                                console.log(message);

                                $.ajax({
                                    url: "{{ route('send.sms') }}", // Use the named route here
                                    method: 'POST',
                                    data: {
                                        recipient: recipient,
                                        message: message
                                    },
                                    headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                    },
                                    success: function (response) {
                                        
                                        bootbox.alert('Appointment status updated successfully and an sms notification was sent to the Patient');
                                    },
                                    error: function (error) {
                                        bootbox.alert('Appointment status updated successfully' );
                                        console.error('SMS sending failed:', error);
                                    }
                                });                               


                            }
                        },
                        error: function (error) {
                            // Handle any errors (e.g., display an error message)
                            console.error(error);
                            bootbox.alert(error);
                        }
                    });
                }
            });

            

            
        });


    </script>
@endpush
