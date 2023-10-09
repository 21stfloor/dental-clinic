@extends('admin.layouts.admin-master')
@section('title', 'Smile Pro HQ | Profile')

@section('content')
    <h1 class="mt-4 text-primary">Profile</h1>
    <div class="row mb-3">
        <div class="col-md-4">
            <div class="card mb-3">
                <div class="card-body text-center shadow"><img class="rounded-circle img-fluid mb-3 mt-4"
                        src="{{ asset('images/logo.png') }}"  />
                    <div class="mb-3">
                        <button class="btn btn-primary btn-sm" type="button">Change Photo</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card shadow">
                <div class="card-header py-3">
                    <p class="text-primary m-0 fw-bold">Contact Settings</p>
                </div>
                <div class="card-body">
                        <div class="mb-3"><label class="form-label"
                                for="address"><strong>Address</strong></label><input id="address"
                                class="form-control" type="text" value="{{ $doctorProfile->address }}" placeholder="Unit 9. Paseo de Carmona"
                                name="address"  form="profileForm" /></div>

                                <div class="mb-3"><label class="form-label"
                                        for="contact_number"><strong>Phone Number</strong></label>
                                        <input id="contact_number" form="profileForm"  class="form-control" type="tel" value="{{ $doctorProfile->contact_number }}" placeholder="+63"
                                        name="contact_number" required/></div>
                                <div class="row">
                            </div>
                        </div>
                        <div class="mb-3">
                        <button class="btn btn-primary btn-sm" form="profileForm" type="submit">Save Settings</button>
                        </div>
                        <form id="profileForm" method="POST" action="{{ route('doctors.update', ['doctor' => $doctorProfile]) }}">
                            @csrf
                            @method('PUT')    
                        </form>
                </div>
            </div>
        </div>

        
    </div>
@endsection
