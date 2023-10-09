@extends('admin.layouts.admin-master')

@section('title', 'Smile Pro HQ | Patient Dashboard')

@push('style')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

    <!-- Include DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">

@endpush

@section('content')
    <h1 class="my-4 text-primary">Upcoming Appointments</h1>
    <div class="row">
        <table id="upcoming-appointments-table" class="table table-striped table-bordered w-100">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Date/Time</th>
                    <th>Type</th>
                    <th>Doctor</th>
                </tr>
            </thead>
        </table>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

    <!-- Include DataTables JS -->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#upcoming-appointments-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('patients.appointments.upcoming') }}",
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'date', name: 'date' },
                    { data: 'type', name: 'type' },
                    { data: 'doctor', name: 'doctor' }
                ]
            });
        });
    </script>
@endpush
