@extends('admin.layouts.admin-master')

@section('title', 'Smile Pro HQ | Patient Dashboard')

@push('style')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

    <!-- Include DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">

@endpush

@section('content')
    <h1 class="my-4 text-primary">History</h1>
    <div class="row">
        <table id="history-table" class="table table-striped table-bordered w-100">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Image</th>
                    <th>Type</th>
                    <th>Doctor</th>
                    <th>Date Completed</th>
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
            $('#history-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('patients.records.records') }}",
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'image', name: 'image' },
                    { data: 'type', name: 'type' },
                    { data: 'doctor', name: 'doctor' },
                    { data: 'date_completed', name: 'date_completed' }
                ]
            });
        });
    </script>
@endpush
