@extends('admin.layouts.admin-master')

@section('title', 'Smile Pro HQ | Schedule')


@section('style')
    <style>
        .legend{
            background-color:#569ff7;
        }
        .flatpickr-day:not(.flatpickr-disabled) {
            /* Your CSS styles for non-disabled days here */
            background-color:#569ff7;
            color: white;
            /* Add any other styles you want */
        }
    </style>    
@endsection

@section('content')
    <h1 class="my-4 text-primary">My Calendar</h1>
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

    <div class="row w-100">
    <!-- <input id="inline-datepicker" class="w-100"/> -->
        <div class="col-12 d-flex justify-content-center">
            <div id="calendar"></div>
        </div>
    </div>


    
    <span class="badge rounded-pill text-white legend mt-5">Has an appointment</span>
@endsection

@push('scripts')
    <script>
        const disabledDates = @json($upcomingAppointments);
        $(document).ready(function(){
            console.log(disabledDates);
                
            // let config = {
                // disable: [
                //     // Disable Sundays
                //     function(date) {
                //         return date.getDay() === 0;
                //     },
                //     // Disable dates in the disabledDates array
                //     function(date) {
                //         var formattedDate = date.getFullYear() + "-" + (date.getMonth() + 1) + "-" + date.getDate();
                //         return disabledDates.includes(formattedDate);
                //     }
                // ],
                // mode: "multiple", // Set the mode to 'multiple' if you want to select multiple dates
                // enable: disabledDates,
            // }

            $('#calendar').flatpickr({
                inline:true,
                    multiple:true,
                    defaultDate:disabledDates,
                    // position: 'auto center',
                    // positionElement:,
                 disable: [
                    // Disable Sundays
                    function(date) {
                        return date.getDay() === 0;
                    },
                    // Disable dates in the disabledDates array
                    function(date) {
                        let day = date.getDate();
                        if(day < 10){
                            day = `0${day}`;
                        }
                        var formattedDate = date.getFullYear() + "-" + (date.getMonth() + 1) + "-" + day;
                        return !disabledDates.includes(formattedDate);
                    }
                ]
            });
            // $('#inline-datepicker').flatpickr();

        });
    </script>
@endpush
