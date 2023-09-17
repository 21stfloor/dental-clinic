@extends('admin.layouts.admin-master')

@section('title', 'Smile Pro HQ | Schedule')

@section('content')
    <h1 class="my-4 text-primary">Schedule Management</h1>
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @elseif (session('info'))
        <div class="alert alert-info">
            {{ session('info') }}
        </div>
    @endif

    @if ($errors->has('day'))
        <div class="alert alert-danger">
            {{ $errors->first('day') }}
        </div>
    @endif

    <div class="row">
        <div class="col">
            <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addScheduleModal">
                <i class="bi bi-calendar-plus me-1"></i> Add Doctor Schedule
            </button>
            <div class="card mb-4">
                <div class="card-body shadow">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTables" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Day</th>
                                    <th>Start</th>
                                    <th>End</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>ID</th>
                                    <th>Day</th>
                                    <th>Start</th>
                                    <th>End</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach ($schedules as $schedule)
                                    <tr>
                                        <td>{{ $schedule->id }}</td>
                                        <td>{{ $schedule->day }}</td>
                                        <td>{{ $schedule->formatted_start_time }}</td>
                                        <td>{{ $schedule->formatted_end_time }}</td>
                                        <td>
                                            @if ($schedule->status == 'active')
                                                <form action="{{ route('doctors.schedules.inactive', $schedule) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <button type="submit" class="btn btn-primary">Active</button>
                                                </form>
                                            @elseif ($schedule->status == 'inactive')
                                                <form action="{{ route('doctors.schedules.active', $schedule) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <button type="submit" class="btn btn-secondary">Inactive</button>
                                                </form>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="d-grid gap-2 d-md-flex justify-content-md-around">
                                                <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                                    data-bs-target="#editScheduleModal{{ $schedule->id }}">
                                                    <i class="bi bi-pen"></i>
                                                </button>

                                                <div class="modal fade" id="editScheduleModal{{ $schedule->id }}"
                                                    data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                                                    aria-labelledby="editScheduleModalLabel{{ $schedule->id }}"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h1 class="modal-title fs-5 text-primary"
                                                                    id="editScheduleModalLabel{{ $schedule->id }}">Edit
                                                                    Doctor
                                                                    Schedule</h1>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form
                                                                    action="{{ route('doctors.schedules.update', $schedule) }}"
                                                                    method="POST" id="editScheduleForm">
                                                                    @csrf
                                                                    @method('PUT')

                                                                    <div class="row">
                                                                        <div class="col">
                                                                            <div class="mb-3">
                                                                                <label for="start_time"
                                                                                    class="form-label">Start Time</label>
                                                                                <input type="time" name="start_time"
                                                                                    id="start_time" class="form-control"
                                                                                    value="{{ $schedule->start_time }}">
                                                                            </div>

                                                                            <div class="mb-3">
                                                                                <label for="end_time" class="form-label">End
                                                                                    Time</label>
                                                                                <input type="time" name="end_time"
                                                                                    id="end_time" class="form-control"
                                                                                    value="{{ $schedule->end_time }}">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Close</button>
                                                                <button type="button" class="btn btn-primary"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#confirmUpdateModal{{ $schedule->id }}">
                                                                    Update Schedule
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="modal fade" id="confirmUpdateModal{{ $schedule->id }}"
                                                    data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                                                    aria-labelledby="confirmUpdateModalLabel{{ $schedule->id }}"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h1 class="modal-title fs-5 text-primary"
                                                                    id="confirmUpdateModalLabel{{ $schedule->id }}">
                                                                    Confirm Update Schedule</h1>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                Are you sure you want to update your schedule?
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#editScheduleModal{{ $schedule->id }}">
                                                                    Back
                                                                </button>

                                                                <button type="submit" class="btn btn-primary"
                                                                    form="editScheduleForm">Save
                                                                    changes</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <button class="btn btn-danger" data-bs-toggle="modal"
                                                    data-bs-target="#confirm-delete-modal" data-id="{{ $schedule->id }}">
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
                    Are you sure you want to delete this schedule?
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

    <div class="modal fade" id="addScheduleModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="addScheduleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 text-primary" id="addScheduleModalLabel">Add Doctor Schedule</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('doctors.schedules.store') }}" method="POST" id="addScheduleForm">
                        @csrf
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label for="" class="form-label">Schedule Date</label>
                                    <input type="date" name="day" id="" class="form-control" hidden>
                                </div>

                                <div class="mb-3">
                                    <label for="" class="form-label">Start Time</label>
                                    <input type="time" name="start_time" id="start_time" class="form-control" value="08:00" hidden>
                                </div>

                                <div class="mb-3">
                                    <label for="" class="form-label">End Time</label>
                                    <input type="time" name="end_time" id="end_time" value="17:00" class="form-control" hidden>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                        data-bs-target="#addScheduleModal2">
                        Add Schedule
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addScheduleModal2" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="addScheduleModal2Label" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 text-primary" id="addScheduleModal2Label">Confirm Add Doctor Schedule</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to add schedule?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-toggle="modal"
                        data-bs-target="#addScheduleModal">Back
                    </button>
                    <button type="submit" class="btn btn-primary" form="addScheduleForm">Save changes</button>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script>
        $(document).ready(function(){
            let config = {
                "disable": [
                // Disable weekends
                    function(date) {
                        return (date.getDay() === 0);
                    },
                ],
                inline: true
            }

            $('input[type="date"]').flatpickr(config)
            
            let startTimeConfig = {
                enableTime: true,
                noCalendar: true,
                dateFormat: "H:i",
                minTime: "08:00",
                maxTime: "17:00",
                inline: true,
            }
            
            $('input[type="time"]').flatpickr(startTimeConfig)
            
        });
    </script>
    <script>
        $('#confirm-delete-modal').on('show.bs.modal', function(event) {
            let button = $(event.relatedTarget)
            let scheduleId = button.data('id')
            let modal = $(this)
            let action = '{{ route('doctors.schedules.destroy', ':id') }}'
            action = action.replace(':id', scheduleId)
            modal.find('#delete-form').attr('action', action)
        })
    </script>
@endpush
