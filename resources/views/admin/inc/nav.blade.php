  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="{{url('/home')}}" class="logo d-flex align-items-center">
        <img src="{{ asset(settingHelper('favicon','/logo.png')) }}" alt="">
        <span class="d-none d-lg-block">Dashboard</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
      <a class="btn btn-outline-primary btn-sm" href="{{route('optimize.clear')}}">Clear Cache</a>
    </div><!-- End Logo -->



    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">



        <li class="nav-item dropdown">

          <a class="nav-link nav-icon" href="{{url('/')}}" target="_blank">
            <i class="bi bi-house-door"></i>
          </a><!-- End Notification Icon -->

        </li><!-- End Notification Nav -->

        <li class="nav-item dropdown pe-3">

          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <img src="{{asset(Auth::user()->avatar ?? '/placeholder.jpg') }}" alt="Profile" class="rounded-circle">
            {{-- <span class="d-none d-md-block dropdown-toggle ps-2 text-uppercase">{{Auth::user()->name}}</span> --}}
          </a><!-- End Profile Iamge Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">

            <li>
              <a class="dropdown-item d-flex align-items-center" href="{{Route('change.password')}}">
                <i class="bi bi-gear"></i>
                <span>Account Settings</span>
              </a>
            </li>

            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="{{ route('logout') }}"
              onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
              <i class="bi bi-power"></i> {{ __('Logout') }}
           </a>
          
           <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
               @csrf
           </form>
            </li>

          </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->

      </ul>
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->
