@extends('layouts.home-master')

@section('title', 'Smile Pro HQ | Services')

@section('style')

@endsection

@section('navbar')
    @include('layouts.partials.navbar-transparent')
@endsection

@section('content')



    <section class="hero">
        <div class="py-5 text-center">
            <img class="d-block mx-auto mb-4 mt-5" src="{{ asset('/images/logo-light.png') }}" alt="" width="100">
            <h1 class="display-1 fw-bold lh-1 mb-3 text-light">SERVICES</h1>
            <div class="col-lg-6 px-5 mx-auto">
                <p class="lead text-light">Here are the services that we offer for you</p>
            </div>
        </div>
    </section>

    @foreach ($services as $index => $service)
        <section class="@if ($index % 2 != 0) bg-primary @endif">
            <div class="container col-xxl-12 px-4 py-5">
                <div class="row @if ($index % 2 == 0) flex-lg-row-reverse @else flex-lg-row @endif align-items-center g-5 py-5">
                    <div class="col-10 col-sm-8 col-lg-6">
                        <img src="<?php echo asset("storage/$service->image") ?>"
                            class="d-block mx-lg-auto img-fluid rounded shadow" alt="{{ $service->title }}" width="500"
                            loading="lazy">
                    </div>
                    <div class="col-lg-6 @if ($index % 2 != 0) text-light @endif">
                        <h1 class="display-5 fw-bold lh-1 mb-3 @if ($index % 2 == 0)text-primary @endif">{{ $service->title }}</h1>
                        <p class="lead">
                            {{ $service->description }}
                        </p>
                    </div>
                </div>
            </div>
        </section>
    @endforeach

    
@endsection

@section('footer')
    @include('layouts.partials.footer')
@endsection
