<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script> 
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">


<div class="main-header">
    <div class="">
        <a href=""><img src="{{ asset('root/upload/logo/dashboard-logo.jpg') }}" alt=""></a>
    </div>


    <div class="menu-toggle">
        <div></div>
        <div></div>
        <div></div>
    </div>

    {{-- <div class="d-flex align-items-center">
        <div class="search-bar">
            <input type="text" placeholder="Search">
            <i class="search-icon text-muted i-Magnifi-Glass1"></i>
        </div>
    </div> --}}

    <div style="margin: auto"></div>

    <div class="header-part-right">
        <div id="preloader">
            <div class="loader spinner spinner-light mr-3">
            </div>
        </div>
        <!-- Full screen toggle -->
        <i class="i-Full-Screen header-icon d-none d-sm-inline-block" data-fullscreen></i>

        <!-- Notificaiton -->
        <style>
    #buttons {
        padding: 5px 5px;
    border: 1px solid;
    border-radius: 5px;
    cursor: pointer;
    text-align: center;
    font-size: 8px;
}
#buttons i:hover{
    color: white;
}

#buttons i {
   color: black;
}

</style>
<div class="dropdown">
    <div class="badge-top-container" role="button" id="dropdownNotification" data-toggle="dropdown"
        aria-haspopup="true" aria-expanded="false">
        <span class="badge text-bg-primary">{{ $notificationsCount ?? 0 }}</span>
        <i class="i-Bell text-muted header-icon"></i>
    </div>

    <!-- Notification dropdown -->
    <div class="dropdown-menu dropdown-menu-right notification-dropdown rtl-ps-none"
        aria-labelledby="dropdownNotification" data-perfect-scrollbar data-suppress-scroll-x="true">

        <!-- Display notifications here -->

                <div class="dropdown-item"> 
                    <div class="notification-icon">
                        <button type="button" class="btn btn-outline-secondary" id="buttons">
                            <i class="fa fa-comments-o" aria-hidden="true" title="New Messages"></i>
                        </button>
                    </div>
                    <div class="notification-details flex-grow-1">
                    </div>
                </div>

</div>
    </div>

        <!-- User avatar dropdown -->
        <div class="dropdown">
            <div class="user col align-self-end">
                <img src="{{ asset('assets/images/faces/dashboard-logo.jpg') }}" id="userDropdown" alt=""
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                    <div class="dropdown-header">
                        <i class="i-Lock-User me-1"></i> Timothy Carlson
                    </div>
                    <a class="dropdown-item">Account settings</a>
                    <a class="dropdown-item">Billing history</a>


                    {{-- logout button  --}}
                    <a class="dropdown-item" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- header top menu end -->
