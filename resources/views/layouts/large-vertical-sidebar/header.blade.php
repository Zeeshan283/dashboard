
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
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
    @notifyCss
    {{-- <div class="d-flex align-items-center">
        <div class="search-bar">
            <input type="text" placeholder="Search            <i class="search-icon text-muted i-Magnifi-Glass1"></i>
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

            #buttons i:hover {
                color: white;
            }

            #buttons i {
                color: black;
            }

            .notification-icon {
        margin-right: 10px;
        margin-bottom: 10px;
    }

    #buttons {
        padding: 5px 10px;
        border: 1px solid transparent;
        border-radius: 50%;
        background-color: #f1f1f1;
        cursor: pointer;
        font-size: 16px;
        transition: background-color 0.3s ease;
    }

    #buttons:hover {
        background-color: #ddd;
    }

    .notification-details {
        display: flex;
        margin-bottom: 10px;
        margin-right: 10px;
        margin-left: 10px;
        margin-top: 10px;
        align-items: center;
    }

    .notification-message {
        border-radius: 10px;
        padding: 10px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        font-size: 14px;
        color: #555;
        max-width: 600px;
    }
        </style>
        <div class="dropdown">
            <div class="badge-top-container" role="button" id="dropdownNotification" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <span class="badge text-bg-primary">{{ $notificationsCount ?? 0 }}</span>
                <i class="i-Bell text-muted header-icon"></i>
            </div>
            <div class="dropdown-menu dropdown-menu-right notification-dropdown rtl-ps-none"
    aria-labelledby="dropdownNotification" data-perfect-scrollbar data-suppress-scroll-x="true">
    <div class="dropdown-item">
        <div class="notification-item">
            <div class="notification-icon">
                <button type="button" class="btn btn-outline-secondary" id="buttons">
                    <i class="far fa-comments" aria-hidden="true" title="New Messages"></i>
                </button>
            </div>
            <div class="notification-details flex-grow-3">
                    <x-notify::notify />
            </div>
        </div>
    </div>
</div>
        </div>
        @notifyJs
        <script>  $(document).ready(function() {
            setTimeout(function() {
                $(".notification-item").fadeOut("slow");
            }, 60000);
        });</script>
<?php
use App\Models\vendorProfile;
$logo = vendorProfile::first();
?>
        <!-- User avatar dropdown -->
        <div class="dropdown">
            <div class="user col align-self-end">
                @if(Auth::user()->role == 'Admin')
                <img src="{{ asset('assets/images/faces/dashboard-logo.jpg') }}" id="userDropdown" alt=""
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                @else
                <img src="/{{ $logo->logo }}" id="userDropdown" alt=""
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                @endif
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

