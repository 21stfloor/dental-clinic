@extends('admin.layouts.admin-master')

@section('title', 'Smile Pro HQ | Doctor Dashboard')

@section('content')
    <h1 class="mt-4 text-primary">Dashboard</h1>
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="card bg-info text-white">
                    <div class="card-body">
                        <h5 class="card-title"><i class="bi bi-clock"></i> Pending Appointments</h5>
                        <h1 class="card-text">{{ $pendingAppointments }}</h1>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card bg-success text-white">
                    <div class="card-body">
                        <h5 class="card-title"><i class="bi bi-check-circle"></i> Completed Appointments</h5>
                        <h1 class="card-text">{{ $completedAppointments }}</h1>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card bg-danger text-white">
                    <div class="card-body">
                        <h5 class="card-title"><i class="bi bi-x-circle"></i> Cancelled Appointments</h5>
                        <h1 class="card-text">{{ $cancelledAppointments }}</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
