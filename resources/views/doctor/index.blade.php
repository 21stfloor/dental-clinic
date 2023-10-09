@extends('admin.layouts.admin-master')

@section('title', 'Smile Pro HQ | Doctor Dashboard')

@section('content')
    <h1 class="mt-4 text-primary">Dashboard</h1>
    <div class="container">
        <div class="row">
            <div class="col-md-4 mb-3">
                <div class="card bg-info text-white">
                    <div class="card-body">
                        <h5 class="card-title"><i class="bi bi-clock"></i> Pending Appointments</h5>
                        <h1 class="card-text">{{ $pendingAppointments }}</h1>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-3">
                <div class="card bg-warning text-white">
                    <div class="card-body">
                        <h5 class="card-title"><i class="bi bi-arrow-up-right-square-fill"></i> Accepted Appointments</h5>
                        <h1 class="card-text">{{ $acceptedAppointments }}</h1>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-3">
                <div class="card bg-primary-subtle text-black">
                    <div class="card-body">
                        <h5 class="card-title"><i class="bi bi-terminal"></i>> Ongoing Appointments</h5>
                        <h1 class="card-text">{{ $ongoingAppointments }}</h1>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-3">
                <div class="card bg-success text-white">
                    <div class="card-body">
                        <h5 class="card-title"><i class="bi bi-bookmark-check"></i> Completed Appointments</h5>
                        <h1 class="card-text">{{ $doneAppointments }}</h1>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-3">
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
