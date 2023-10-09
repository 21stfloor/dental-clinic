@extends('admin.layouts.admin-master')
@section('title', 'Smile Pro HQ | Profile')

@section('content')
    <h1 class="mt-4 text-primary">Profile</h1>
    <div class="row mb-3">
        <div class="col-lg-4">
            <div class="card mb-3">
                <div class="card-body text-center shadow"><img class="rounded-circle mb-3 mt-4"
                        src="{{ asset('images/logo.png') }}" width="160" height="160" />
                    <div class="mb-3">
                        <button class="btn btn-primary btn-sm" type="button">Change Photo</button>
                    </div>
                </div>
            </div>
            
        </div>
        <div class="col-lg-8">
            <div class="row mb-3 d-none">
                <div class="col">
                    <div class="card text-white bg-primary shadow">
                        <div class="card-body">
                            <div class="row mb-2">
                                <div class="col">
                                    <p class="m-0">Peformance</p>
                                    <p class="m-0"><strong>65.2%</strong></p>
                                </div>
                                <div class="col-auto"><i class="fas fa-rocket fa-2x"></i></div>
                            </div>
                            <p class="text-white-50 small m-0"><i class="fas fa-arrow-up"></i> 5% since last month</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card text-white bg-success shadow">
                        <div class="card-body">
                            <div class="row mb-2">
                                <div class="col">
                                    <p class="m-0">Peformance</p>
                                    <p class="m-0"><strong>65.2%</strong></p>
                                </div>
                                <div class="col-auto"><i class="fas fa-rocket fa-2x"></i></div>
                            </div>
                            <p class="text-white-50 small m-0"><i class="fas fa-arrow-up"></i> 5% since last month</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="card shadow mb-3">
                        <div class="card-header py-3">
                            <p class="text-primary m-0 fw-bold">User Settings</p>
                        </div>
                        <div class="card-body">
                            <form>
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3"><label class="form-label"
                                                for="username"><strong>Username</strong></label><input id="username" form="profileForm" 
                                                class="form-control" type="text" value="{{ $patient->username }}" placeholder="user.name"
                                                name="username" /></div>
                                    </div>
                                    <div class="col">
                                        <div class="mb-3"><label class="form-label" for="email"><strong>Email
                                                    Address</strong></label><input id="email" class="form-control" form="profileForm" 
                                                type="email" value="{{ $patient->email }}" placeholder="user@example.com" name="email" /></div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3"><label class="form-label" for="first_name"><strong>First
                                                    Name</strong></label><input id="first_name" class="form-control" form="profileForm" 
                                                type="text" value="{{ $patient->first_name }}" placeholder="John" name="first_name" /></div>
                                    </div>
                                    <div class="col">
                                        <div class="mb-3"><label class="form-label" for="last_name"><strong>Last
                                                    Name</strong></label><input id="last_name" class="form-control" form="profileForm" 
                                                type="text" value="{{ $patient->last_name }}" placeholder="Doe" name="last_name" /></div>
                                    </div>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="birthday">Birthday:</label>
                                    <input type="date" class="form-control" id="birthday" name="birthday" value="{{ $patientProfile->birthday }}" form="profileForm" >
                                </div>

                                <!-- Gender Input -->
                                <div class="form-group mb-3">
                                    <label for="gender">Gender:</label>
                                    <select class="form-control" id="gender" name="gender" value="{{ $patientProfile->gender }}" form="profileForm" >
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                        <option value="other">Other</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <button class="btn btn-primary btn-sm"  form="profileForm" type="submit">Save Settings</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="card shadow">
                        <div class="card-header py-3">
                            <p class="text-primary m-0 fw-bold">Contact Settings</p>
                        </div>
                        <div class="card-body">
                            
                                
                                <div class="mb-3"><label class="form-label"
                                        for="address"><strong>Address</strong></label><input id="address" form="profileForm" 
                                        class="form-control" type="text" value="{{ $patientProfile->address }}" placeholder="Unit 9. Paseo de Carmona"
                                        name="address" /></div>
                                <div class="mb-3"><label class="form-label"
                                        for="contact_number"><strong>Phone Number</strong></label>
                                        <input id="contact_number" form="profileForm"  class="form-control" type="tel" value="{{ $patientProfile->contact_number }}" placeholder="+63"
                                        name="contact_number" required/></div>
                                <div class="mb-3">
                                    <button class="btn btn-primary btn-sm" form="profileForm" type="submit">Save Settings</button>
                                </div>
                                <form id="profileForm" method="POST" action="{{ route('patients.update', ['patient' => $patientProfile]) }}">
                                    @csrf
                                    @method('PUT')    
                                </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@push('scripts')
    <script>
$(document).ready(function(){
    $('input[type="date"]').flatpickr();
})


</script>

@endpush