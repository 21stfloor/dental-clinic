@extends('admin.layouts.admin-master')

@section('title', 'Smile Pro HQ | Patients')

@section('content')
    <h1 class="my-4 text-primary">Patients</h1>
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @elseif(session('info'))
        <div class="alert alert-info">
            {{ session('info') }}
        </div>
    @endif

    <div class="row">
        <div class="col">
            
            <div class="card mb-4">
                <div class="card-body shadow">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTables" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Avatar</th>
                                    <th>Name</th>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>Birthday</th>
                                    <th>Gender</th>
                                    <th>Contact Number</th>
                                    <th>Created At</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>ID</th>
                                    <th>Avatar</th>
                                    <th>Name</th>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>Birthday</th>
                                    <th>Gender</th>
                                    <th>Contact Number</th>
                                    <th>Created At</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach ($patients as $patient)
                                    <tr>
                                        <td>{{ $patient->id }}</td>
                                        <td>
                                            @if ($patient->user->avatar)
                                                <img src="{{ $patient->user->avatar }}" alt="Avatar"
                                                    class="img-fluid rounded-circle avatar">
                                            @else
                                                <img src="{{ asset('images/avatar.jpg') }}" alt="Avatar"
                                                    class="img-fluid rounded-circle avatar">
                                            @endif
                                        </td>
                                        <td>{{ $patient->first_name . ' ' . $patient->last_name }}</td>
                                        <td>{{ $patient->user->username }}</td>
                                        <td>{{ $patient->email }}</td>
                                        <td>{{ $patient->formatted_birthday }}</td>
                                        <td>{{ ucfirst($patient->gender) }}</td>
                                        <td>{{ $patient->contact_number }}</td>
                                        <td>{{ $patient->created_at->diffForHumans() }}</td>
                                        <td>
                                            <div class="d-grid gap-2 d-md-flex justify-content-md-around">
                                                <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                                    data-bs-target="#editPatientModal{{ $patient->id }}">
                                                    <i class="bi bi-pen"></i>
                                                </button>

                                                <div class="modal fade" id="editPatientModal{{ $patient->id }}"
                                                    data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                                                    aria-labelledby="editPatientModalLabel{{ $patient->id }}"
                                                    aria-hidden="true">
                                                    <div
                                                        class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h1 class="modal-title fs-5 text-primary"
                                                                    id="editPatientModalLabel{{ $patient->id }}">Edit
                                                                    Patient</h1>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="card">
                                                                    <div class="card-body shadow">
                                                                        <div class="text-center mb-3">
                                                                            @if ($patient->user->avatar)
                                                                                <img src="{{ $patient->user->avatar }}"
                                                                                    alt="Avatar"
                                                                                    class="img-fluid rounded-circle avatar">
                                                                            @else
                                                                                <img src="{{ asset('images/avatar.jpg') }}"
                                                                                    alt="Avatar"
                                                                                    class="img-fluid rounded-circle avatar">
                                                                            @endif
                                                                        </div>

                                                                        <form
                                                                            action="{{ route('patients.update', $patient) }}"
                                                                            method="POST" id="editPatientForm"
                                                                            enctype="multipart/form-data">
                                                                            @csrf
                                                                            @method('PUT')
                                                                            <div class="row">
                                                                                <div class="col-md-12">
                                                                                    <div class="mb-3">
                                                                                        <label for="formFile"
                                                                                            class="form-label">Update
                                                                                            avatar</label>
                                                                                        <input class="form-control"
                                                                                            type="file" id="formFile"
                                                                                            name="avatar">
                                                                                    </div>
                                                                                </div>

                                                                                <div class="col-md-6">
                                                                                    <div class="mb-3">
                                                                                        <label for="first_name"
                                                                                            class="form-label">{{ __('First Name') }}</label>

                                                                                        <input id="first_name"
                                                                                            type="text"
                                                                                            class="form-control @error('first_name') is-invalid @enderror"
                                                                                            name="first_name"
                                                                                            value="{{ $patient->first_name }}">

                                                                                        @error('first_name')
                                                                                            <span class="invalid-feedback"
                                                                                                role="alert">
                                                                                                <strong>{{ $message }}</strong>
                                                                                            </span>
                                                                                        @enderror
                                                                                    </div>
                                                                                </div>

                                                                                <div class="col-md-6">
                                                                                    <div class="mb-3">
                                                                                        <label for="last_name"
                                                                                            class="form-label">{{ __('Last Name') }}</label>

                                                                                        <input id="last_name" type="text"
                                                                                            class="form-control @error('last_name') is-invalid @enderror"
                                                                                            name="last_name"
                                                                                            value="{{ $patient->last_name }}">

                                                                                        @error('last_name')
                                                                                            <span class="invalid-feedback"
                                                                                                role="alert">
                                                                                                <strong>{{ $message }}</strong>
                                                                                            </span>
                                                                                        @enderror
                                                                                    </div>
                                                                                </div>

                                                                                <div class="col-md-6">
                                                                                    <div class="mb-3">
                                                                                        <label for="email"
                                                                                            class="form-label">{{ __('Email') }}</label>

                                                                                        <input id="email" type="email"
                                                                                            class="form-control @error('email') is-invalid @enderror"
                                                                                            name="email"
                                                                                            value="{{ $patient->email }}">

                                                                                        @error('email')
                                                                                            <span class="invalid-feedback"
                                                                                                role="alert">
                                                                                                <strong>{{ $message }}</strong>
                                                                                            </span>
                                                                                        @enderror
                                                                                    </div>
                                                                                </div>

                                                                                <div class="col-md-6">
                                                                                    <div class="mb-3">
                                                                                        <label for="contact_number"
                                                                                            class="form-label">{{ __('Contact Number') }}</label>

                                                                                        <input id="contact_number"
                                                                                            type="text"
                                                                                            class="form-control @error('contact_number') is-invalid @enderror"
                                                                                            name="contact_number"
                                                                                            value="{{ $patient->contact_number }}">

                                                                                        @error('contact_number')
                                                                                            <span class="invalid-feedback"
                                                                                                role="alert">
                                                                                                <strong>{{ $message }}</strong>
                                                                                            </span>
                                                                                        @enderror
                                                                                    </div>
                                                                                </div>

                                                                                <div class="col-md-6">
                                                                                    <div class="mb-3">
                                                                                        <label for="birthday"
                                                                                            class="form-label">{{ __('Birthday') }}</label>
                                                                                        <input type="date"
                                                                                            class="form-control @error('birthday') is-invalid @enderror"
                                                                                            id="birthday" name="birthday"
                                                                                            value="{{ $patient->birthday }}">

                                                                                        @error('birthday')
                                                                                            <span class="invalid-feedback"
                                                                                                role="alert">
                                                                                                <strong>{{ $message }}</strong>
                                                                                            </span>
                                                                                        @enderror
                                                                                    </div>
                                                                                </div>

                                                                                <div class="col-md-6">
                                                                                    <div class="mb-3">
                                                                                        <label for="gender"
                                                                                            class="form-label">{{ __('Gender') }}</label>

                                                                                        <select
                                                                                            class="form-select @error('gender') is-invalid @enderror"
                                                                                            id="gender" name="gender"
                                                                                            form="editPatientForm">
                                                                                            <option selected disabled>Select
                                                                                                Gender
                                                                                            </option>
                                                                                            <option value="male"
                                                                                                {{ $patient->gender == 'male' ? 'selected' : '' }}>
                                                                                                Male
                                                                                            </option>
                                                                                            <option value="female"
                                                                                                {{ $patient->gender == 'female' ? 'selected' : '' }}>
                                                                                                Female
                                                                                            </option>
                                                                                            <option value="nonbinary"
                                                                                                {{ $patient->gender == 'nonbinary' ? 'selected' : '' }}>
                                                                                                Non-binary
                                                                                            </option>
                                                                                            <option value="transgender"
                                                                                                {{ $patient->gender == 'transgender' ? 'selected' : '' }}>
                                                                                                Transgender
                                                                                            </option>
                                                                                        </select>

                                                                                        @error('gender')
                                                                                            <span class="invalid-feedback"
                                                                                                role="alert">
                                                                                                <strong>{{ $message }}</strong>
                                                                                            </span>
                                                                                        @enderror
                                                                                    </div>
                                                                                </div>

                                                                                <div class="col-md-12">
                                                                                    <div class="mb-3">
                                                                                        <label for="address"
                                                                                            class="form-label">{{ __('Address') }}</label>

                                                                                        <input id="address"
                                                                                            type="text"
                                                                                            class="form-control @error('address') is-invalid @enderror"
                                                                                            name="address"
                                                                                            value="{{ $patient->address }}">

                                                                                        @error('address')
                                                                                            <span class="invalid-feedback"
                                                                                                role="alert">
                                                                                                <strong>{{ $message }}</strong>
                                                                                            </span>
                                                                                        @enderror
                                                                                    </div>
                                                                                </div>


                                                                                <div class="col-md-12">
                                                                                    <div class="mb-3">
                                                                                        <label for="username"
                                                                                            class="form-label">{{ __('Username') }}</label>

                                                                                        <input id="username"
                                                                                            type="text"
                                                                                            class="form-control @error('username') is-invalid @enderror"
                                                                                            name="username"
                                                                                            value="{{ $patient->user->username }}">

                                                                                        @error('username')
                                                                                            <span class="invalid-feedback"
                                                                                                role="alert">
                                                                                                <strong>{{ $message }}</strong>
                                                                                            </span>
                                                                                        @enderror
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Close</button>
                                                                <button type="button" class="btn btn-primary"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#updatePatientModal{{ $patient->id }}">
                                                                    Update Patient
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="modal fade" id="updatePatientModal{{ $patient->id }}"
                                                    data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                                                    aria-labelledby="updatePatientModalLabel{{ $patient->id }}"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered modal-scrollable">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h1 class="modal-title fs-5 text-primary"
                                                                    id="updatePatientModalLabel{{ $patient->id }}">
                                                                    Confirm Edit Patient</h1>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                Are you sure you want to update the patient's information?
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#editPatientModal{{ $patient->id }}">
                                                                    Back
                                                                </button>
                                                                <button type="submit" class="btn btn-primary"
                                                                    form="editPatientForm">Save
                                                                    changes</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <button class="btn btn-danger" data-bs-toggle="modal"
                                                    data-bs-target="#confirm-delete-modal" data-id="{{ $patient->id }}">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="confirm-delete-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="confirm-delete-modal-label" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-primary" id="confirm-delete-modal-label">Confirm Delete</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this patient?
                </div>
                <div class="modal-footer">
                    <form id="delete-form" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addPatientModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="addPatientModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 text-primary" id="addPatientModalLabel">Add Patient</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('patients.store') }}" method="POST" id="addPatientForm">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="first_name" class="form-label">{{ __('First Name') }}</label>

                                    <input id="first_name" type="text"
                                        class="form-control @error('first_name') is-invalid @enderror" name="first_name"
                                        value="{{ old('first_name') }}">

                                    @error('first_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="last_name" class="form-label">{{ __('Last Name') }}</label>

                                    <input id="last_name" type="text"
                                        class="form-control @error('last_name') is-invalid @enderror" name="last_name"
                                        value="{{ old('last_name') }}">

                                    @error('last_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="email" class="form-label">{{ __('Email') }}</label>

                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="contact_number" class="form-label">{{ __('Contact Number') }}</label>

                                    <input id="contact_number" type="text"
                                        class="form-control @error('contact_number') is-invalid @enderror"
                                        name="contact_number" value="{{ old('contact_number') }}">

                                    @error('contact_number')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="birthday" class="form-label">{{ __('Birthday') }}</label>
                                    <input type="date" class="form-control @error('birthday') is-invalid @enderror"
                                        id="birthday" name="birthday" value="{{ old('birthday') }}">

                                    @error('birthday')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="gender" class="form-label">{{ __('Gender') }}</label>

                                    <select class="form-select @error('gender') is-invalid @enderror" id="gender"
                                        name="gender" form="addPatientForm">
                                        <option selected disabled>Select Gender</option>
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                        <option value="nonbinary">Non-binary</option>
                                        <option value="transgender">Transgender</option>
                                    </select>

                                    @error('gender')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="address" class="form-label">{{ __('Address') }}</label>

                                    <input id="address" type="text"
                                        class="form-control @error('address') is-invalid @enderror" name="address"
                                        value="{{ old('address') }}">

                                    @error('address')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="username" class="form-label">{{ __('Username') }}</label>

                                    <input id="username" type="text"
                                        class="form-control @error('username') is-invalid @enderror" name="username"
                                        value="{{ old('username') }}">

                                    @error('username')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="password" class="form-label">{{ __('Password') }}</label>

                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="confirm_password" class="form-label">{{ __('Confirm Password') }}</label>

                                    <input id="password-confirm" type="password" class="form-control"
                                        name="password_confirmation">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                        data-bs-target="#addPatientModal2">
                        Add Patient
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addPatientModal2" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="addPatientModal2Label" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 text-primary" id="addPatientModal2Label">Confim Add Patient</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to add patient?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-toggle="modal"
                        data-bs-target="#addPatientModal">Back</a>
                        <button type="submit" class="btn btn-primary" form="addPatientForm">Save changes</button>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script>
        $('#confirm-delete-modal').on('show.bs.modal', function(event) {
            let button = $(event.relatedTarget)
            let patientId = button.data('id')
            let modal = $(this)
            let action = '{{ route('patients.destroy', ':id') }}'
            action = action.replace(':id', patientId)
            modal.find('#delete-form').attr('action', action)
        });
    </script>
@endpush
