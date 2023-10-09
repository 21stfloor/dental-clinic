@extends('admin.layouts.admin-master')

@section('title', 'Smile Pro HQ | Admin Dashboard')

@section('content')
    <h1 class="mt-4 text-primary">Dashboard</h1>
    <div class="container">
        <div class="row">
            <div class="row mt-4">
                <div class="col-md-4 mb-2">
                    <div class="card bg-primary text-white">
                        <div class="card-body">
                            <h5 class="card-title"><i class="bi bi-people"></i> Total Users</h5>
                            <h1 class="card-text">{{ $totalUsers }}</h1>
                        </div>
                    </div>
                </div>

                

                <div class="col-md-4 mb-2">
                    <div class="card bg-info text-white">
                        <div class="card-body">
                            <h5 class="card-title"><i class="bi bi-person"></i> Total Patients</h5>
                            <h1 class="card-text">{{ $totalPatients }}</h1>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 mb-2">
                    <div class="card bg-success text-white">
                        <div class="card-body">
                            <h5 class="card-title"><i class="bi bi-person-check"></i> Total Doctors</h5>
                            <h1 class="card-text">{{ $totalDoctors }}</h1>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 mb-2">
                    <div class="card bg-secondary text-white">
                        <div class="card-body">
                            <h5 class="card-title"><i class="bi bi-clock-history"></i> Recent Logins Today</h5>
                            <h1 class="card-text">{{ $recentLogins }}</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
