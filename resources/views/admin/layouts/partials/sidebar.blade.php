<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-light" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <div class="sb-sidenav-menu-heading">Core</div>
                <a class="nav-link" href="{{ route('home') }}">
                    <div class="sb-nav-link-icon"><i class="bi bi-speedometer fs-5"></i></div>
                    Dashboard
                </a>


                @if (Auth::user()->hasRole('doctor'))
                    <div class="sb-sidenav-menu-heading">Appointments</div>
                    <a class="nav-link" href="{{ route('doctors.schedules.index') }}">
                        <div class="sb-nav-link-icon"><i class="bi bi-calendar-plus fs-5"></i></div>
                        Set Schedule
                    </a>
                @elseif(Auth::user()->hasRole('patient'))
                    <div class="sb-sidenav-menu-heading">Appointments</div>
                    <a class="nav-link" href="{{ route('patients.appointments.index') }}">
                        <div class="sb-nav-link-icon"><i class="bi bi-calendar-plus fs-5"></i></div>
                        Set Appointment
                    </a>
                @endif

                @if (Auth::user()->hasRole('admin'))
                    <div class="sb-sidenav-menu-heading">Users</div>
                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                        data-bs-target="#collapseUserInformation" aria-expanded="false"
                        aria-controls="collapseUserInformation">
                        <div class="sb-nav-link-icon"><i class="bi bi-people fs-5"></i></div>
                        Accounts
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapseUserInformation" aria-labelledby="headingOne"
                        data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="{{ route('patients.index') }}">
                                <div class="sb-nav-link-icon"><i class="bi bi-person fs-5"></i></div>
                                Patients
                            </a>
                            <a class="nav-link" href="{{ route('doctors.index') }}">
                                <div class="sb-nav-link-icon"><i class="bi bi-person fs-5"></i></div>
                                Doctors
                            </a>

                        </nav>
                    </div>

                    <div class="sb-sidenav-menu-heading">Admin</div>

                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                        data-bs-target="#collapseAccessControl" aria-expanded="false"
                        aria-controls="collapseAccessControl">
                        <div class="sb-nav-link-icon"><i class="bi bi-gear fs-5"></i></div>
                        Access Control
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapseAccessControl" aria-labelledby="headingOne"
                        data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="{{ route('roles.index') }}">
                                <div class="sb-nav-link-icon"><i class="bi bi-person-lines-fill fs-5"></i></div>
                                Roles
                            </a>
                            <a class="nav-link" href="{{ route('permissions.index') }}">
                                <div class="sb-nav-link-icon"><i class="bi bi-person-fill-gear fs-5"></i></div>
                                Permissions
                            </a>
                        </nav>
                    </div>
                @endif
            </div>
        </div>
        <div class="sb-sidenav-footer">
            <div class="small">Logged in as:</div>
            {{ Auth::user()->first_name . ' ' . Auth::user()->last_name }}
        </div>
    </nav>
</div>
