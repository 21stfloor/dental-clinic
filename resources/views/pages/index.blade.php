@extends('layouts.home-master')

@section('title', 'Smile Pro HQ | Home')

@section('navbar')
    @include('layouts.partials.navbar-transparent')
@endsection

@section('content')
    <!-- Parallax hero section -->
    <section class="parallax-hero d-flex align-items-center">
        <div class="container">
            <div class="row">
                <div class="text-light">
                    <h2 class="fw-bold lh-1 mb-3">Welcome to</h2>
                    <h1 class="display-1 fw-bold lh-1 mb-3">Smile Pro HQ</h1>
                    <h2 class="fw-bold lh-1 mb-3">Your Trusted Dental Care Provider!</h2>
                </div>
            </div>
        </div>
    </section>
    <!-- End of Parallax hero section -->

    <section class="container col-xxl-12 px-4 py-5 mb-5">
        <div class="row flex-lg-row-reverse align-items-center g-5 py-5">
            <div class="col-10 col-sm-8 col-lg-6">       
            <div class="ratio ratio-16x9">         
                <iframe src="https://www.facebook.com/plugins/video.php?height=314&href=https%3A%2F%2Fwww.facebook.com%2Fdocalvindc%2Fvideos%2F654242692610649%2F&show_text=false&width=560&t=0" width="560" height="314" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowfullscreen="true" allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share" allowFullScreen="true"></iframe>                
            </div>
            </div>
            <div class="col-lg-6">
                <h3 class="display-5 fw-bold lh-1 mb-3 text-primary">Hello! This is</h3>
                <h2 class="mb-4 display-3 fw-bold lh-1 mb-3 text-primary">Smile Pro HQ</h2>
                <p class="lead">
                Quality Dental Care You Can Trusts
                </p>
            </div>
        </div>
    </section>

    <section class="bg-primary">
        <div class="container px-4 py-5 mb-5">
            <h2 class="display-3 pb-2 text-center text-light fw-bold lh-1 mb-3">How could we help you?</h2>
            <div class="row">
                <div class="col-md-8 mx-auto">
                    <div class="accordion py-5" id="accordionExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    <h3 class="text-primary fw-bold lh-1 mb-3">
                                        Time for a checkup?
                                    </h3>
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse show"
                                 data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <p class="lead">We've got you covered with personalized cleanings, painless
                                        fillings,
                                        crowns,
                                        dentures, and
                                        bridges.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    <h3 class="text-primary fw-bold lh-1 mb-3">
                                        Fix damaged teeth
                                    </h3>
                                </button>
                            </h2>
                            <div id="collapseTwo" class="accordion-collapse collapse"
                                 data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <p class="lead">Expert surgical care from the team you know and trust. Implants,
                                        canals,
                                        extractions and
                                        more.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseThree" aria-expanded="false"
                                        aria-controls="collapseThree">
                                    <h3 class="text-primary fw-bold lh-1 mb-3">
                                        Improve your smile
                                    </h3>
                                </button>
                            </h2>
                            <div id="collapseThree" class="accordion-collapse collapse"
                                 data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <p class="lead">We'll help you understand high-tech cosmetic options, like
                                        Invisalign,
                                        veneers, teeth
                                        whitening, and Botox.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseFour" aria-expanded="false"
                                        aria-controls="collapseFour">
                                    <h3 class="text-primary fw-bold lh-1 mb-3">
                                        Get to know us
                                    </h3>
                                </button>
                            </h2>
                            <div id="collapseFour" class="accordion-collapse collapse"
                                 data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <p class="lead">Led by Dr. Alvin V. Reate, our team is proud to offer a fresh take on
                                        going to
                                        the dentist in
                                        Carmona, Philippines
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="container col-xxl-12 px-4 py-5">
            <h2 class="display-3 pb-2 text-center text-primary fw-bold lh-1 mb-3">Contact Us</h2>
            <div class="row flex-lg-row-reverse align-items-center g-5 py-5">
                <div class="col-10 col-sm-8 col-lg-6">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3865.76898599715!2d121.06009126969214!3d14.324847153139324!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3397d7b54d0dec27%3A0xae573fe8df627358!2sSmileProHQ%20by%20Dr.%20Alvin%20V.%20Reate!5e0!3m2!1sen!2sph!4v1694718472882!5m2!1sen!2sph" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"
                    class="ratio ratio-1x1 rounded shadow"></iframe>
                </div>

                <div class="col-lg-6">
                    <h2 class="mb-4 display-3 fw-bold lh-1 mb-3 text-primary">Location</h2>
                    <h3 class="fw-bold lh-1 mb-3 text-primary">Unit 9. Paseo de Carmona</h3>
                    <h3 class="fw-bold lh-1 mb-3 text-primary">Carmona, Philippines, 4116</h3>
                    <p class="lead mb-3">
                        We offer TMJ treat ment and smile rehabilitation
                    </p>
                </div>
            </div>
        </div>
    </section>

    <div class="bg-primary">
        <section class="container col-xxl-12 px-4 py-5 text-light">
            <div class="row g-5 py-5">
                <div class="col-10 col-sm-8 col-lg-6">
                    <h2 class="mb-4 display-3 fw-bold lh-1 mb-3">Phone</h2>
                    <p class="lead mb-3">
                        Thank you for your interest in Smile Pro HQ. Please use the following contact information
                        to
                        get in touch with us:
                    </p>
                    <a href="tel:+639173185385" class="text-white"><h3 class="fw-bold lh-1 mb-3"><i class="bi bi-phone-fill me-3"></i>+63917 318 5385</h3></a>
                    <a href="mailto:alvindmd@gmail.com" class="text-white"><h3 class="fw-bold lh-1 mb-3"><i class="bi bi-envelope-fill me-3"></i>alvindmd@gmail.com</h3></a>
                </div>
                <div class="col-lg-6">
                    <h2 class="mb-4 display-3 fw-bold lh-1 mb-3">Hours</h2>
                    <p class="lead mb-3">Please note that these operating hours may be subject to change during holidays
                        or
                        special events. We recommend calling ahead to confirm our availability and schedule your
                        appointment. Thank you for choosing Smile Pro HQ.</p>
                    <ul class="list-group list-group-horizontal-md">
                        <li class="list-group-item lead">Mon - Fri: <br>9am - 6pm</li>
                        <li class="list-group-item lead">Sat: 10am - <br>2pm</li>
                        <li class="list-group-item lead">Sun: <br>Closed</li>
                    </ul>
                </div>
            </div>
        </section>
    
@endsection

@section('footer')
    @include('layouts.partials.footer')
@endsection
