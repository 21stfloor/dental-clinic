@extends('admin.layouts.admin-master')

@section('title', 'Smile Pro HQ | Patient Dashboard')

@push('style')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

    <!-- Include DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">

@endpush

@section('content')
    <h1 class="mb-1 text-primary">Patients History Records</h1>
    <br>
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
    <button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#exampleModal">Create record</button>
    <div class="row">
        <table id="records-table" class="table table-striped table-bordered w-100">
            <thead>
                <tr>
                    <th id="id">ID</th>
                    <th id="patient">Patient</th>
                    <th id="image">Image</th>
                    <th id="type">Type</th>
                    <th id="doctor">Doctor</th>
                    <th id="date_completed">Date Completed</th>
                    <th>Action</th>
                </tr>
            </thead>
        </table>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Create record</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form id="createForm" action="{{ route('doctors.records.create') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="patient_id">Patient ID:</label>
                    <select class="form-control" id="patient_id" name="patient_id" required>
                        @foreach ($patients as $patient)
                            <option value="{{ $patient->id }}">{{ $patient->last_name . $patient->first_name}}</option>
                        @endforeach
                    </select>
                </div>


                <!-- Image -->
                <div class="form-group">
                    <label for="image">Image:</label>
                    <input type="file" class="form-control-file" id="image" name="image" required>
                </div>

                <!-- Date Completed -->
                <div class="form-group">
                    <label for="date_completed">Date Completed:</label>
                    <input type="date" class="form-control" id="date_completed" name="date_completed" required>
                </div>

                <!-- Type -->
                <label for="type" class="form-label">Type</label>
                <select class="form-select" aria-label="Default select example" name="type" id="type" form="createForm" required>
                    <option selected>Select a service type</option>
                    <?php $__currentLoopData = $serviceTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($service->title); ?>">
                            <?php echo e($service->title); ?>
                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>

                <!-- Summary -->
                <div class="form-group">
                    <label for="summary">Summary:</label>
                    <textarea class="form-control" id="summary" name="summary" rows="4" required></textarea>
                </div>

                <div class="form-group">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" form="createForm" class="btn btn-success">Add new record</button>
                </div>
            </form>
        </div>
        <!-- <div class="modal-footer">
            
        </div> -->
        </div>
    </div>
    </div>

    <!-- <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"> -->
    <div class="modal fade" id="viewModal" tabindex="-1"aria-labelledby="viewModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewModalLabel">View Record</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                <div class="modal-body">
                    <!-- Data will be displayed here -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <meta name="csrf-token" content="{{ csrf_token() }}">

@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

    <!-- Include DataTables JS -->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/6.0.0/bootbox.min.js" integrity="sha512-oVbWSv2O4y1UzvExJMHaHcaib4wsBMS5tEP3/YkMP6GmkwRJAa79Jwsv+Y/w7w2Vb/98/Xhvck10LyJweB8Jsw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootbox@5.5.2/dist/bootbox.min.js"></script> -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script> -->
    <script>
        $(document).ready(function() {
            $('input[type="date"]').flatpickr();

            $('#records-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('doctors.records.records') }}",
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'patient', name: 'patient' },
                    {
                        data: 'image', // Assuming 'image' is the column containing image URLs
                        name: 'image',
                        render: function(data, type, row) {
                            // Display the image as a thumbnail with the corrected storage path
                            return '<img src="/storage/' + data + '" alt="Image" width="50" height="50">';
                        }
                    },
                    { data: 'type', name: 'type' },
                    { data: 'doctor', name: 'doctor' },
                    { data: 'date_completed', name: 'date_completed' },
                    {
                        data: null,
                        render: function(data, type, row) {
                            // Add "View" and "Delete" buttons in the Action column
                            return '<button class="btn btn-primary view-btn" data-id="' + data.id + '">View</button> ' +
                                '<button class="btn btn-danger delete-btn" data-id="' + data.id + '">Delete</button>';
                        },
                        orderable: false, // Disable sorting on this column
                        searchable: false // Disable searching on this column
                    }
                ]
            });
        });
    </script>
    <script>
        // Handle the View button click event
        // Handle click events on view buttons
        // Handle click events on view buttons
        $(document).on('click', '.view-btn', function () {
            // Get the row data
            var row = $(this).closest('tr');
            var rowData = {};

            // Iterate through table headers and extract data by matching column IDs
            $('thead th').each(function () {
                var columnId = $(this).attr('id');
                var columnValue = row.find('td:eq(' + $(this).index() + ')');

                // Special handling for the 'image' column
                if (columnId === 'image') {
                    data = columnValue.find('img').attr('src'); // Get the src attribute of the <img> tag
                    columnValue = '<img src="'+ data + '" alt="Image" class="img-fluid">'
                } else {
                    columnValue = columnValue.text(); // For other columns, get the text content
                }

                rowData[columnId] = columnValue;
            });

            // Create and populate the modal content
            var modalContent = '';
            $.each(rowData, function (key, value) {
                modalContent += '<p>' + key + ': ' + value + '</p>';
            });

            // Display the data in the Bootstrap modal
            $('#viewModal .modal-body').html(modalContent);
            $('#viewModal').modal('show');
        });



        // Handle the Delete button click event
        $(document).on('click', '.delete-btn', function () {
            // Get the data from the row
            var row = $(this).closest('tr');
            var id = row.find('td:eq(0)').text();
            var name = row.find('td:eq(1)').text();
            var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            // Display a bootbox confirmation dialog
            bootbox.confirm({
                message: 'Are you sure you want to delete ' + name + '?',
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
                        var url = "{{ route('doctors.records.delete', ['id' => ':id']) }}";
                        // var url = "{{ route('doctors.records.delete',':id') }}";
                        url = url.replace(':id', id);
                        // Send an AJAX request to delete the record
                        $.ajax({
                            type: 'DELETE',
                            // Assuming you have a JavaScript variable 'id' containing the record ID
                            url: url,
                            headers: {
                                'X-CSRF-TOKEN': csrfToken // Include the CSRF token in the headers
                            },
                            //url: '/delete-record/' + id, // Adjust the URL to match your route
                            success: function (response) {
                                // Check if the deletion was successful
                                if (response && response.message === 'Record deleted successfully') {
                                    // Remove the row from the table
                                    row.remove();
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
