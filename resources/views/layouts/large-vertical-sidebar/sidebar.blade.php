<div class="side-content-wrap">
    <div class="sidebar-left open rtl-ps-none" data-perfect-scrollbar data-suppress-scroll-x="true">
        <ul class="navigation-left">
            @if (Auth::User()->role=='Admin')
            @include('sidebar.admin')
        @elseif (Auth::User()->role=='Vendor')
            @include('sidebar.vendor')
        @endif
        </ul>
            {{-- <li class="nav-item">
                <a class="nav-item-hold" href="http://demos.ui-lib.com/gull-htms-doc/" target="_blank">
                    <i class="nav-icon i-Safe-Box1"></i>
                    <span class="nav-text">Doc</span>
                </a>
                <div class="triangle"></div>
            </li> --}}
        </ul>
    </div>

    <div class="sidebar-left-secondary rtl-ps-none" data-perfect-scrollbar data-suppress-scroll-x="true">
        <!-- Submenu Dashboards -->
        <ul class="childNav" data-parent="users">

            <li class="nav-item">
                <a  href="{{ route('user.add') }}">
                    <i class="nav-icon i-File-Clipboard-Text--Image"></i>
                    <span class="item-name">Add New User</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="{{ Route::currentRouteName() == 'userlist' ? 'open' : '' }}"
                    href="{{ route('userlist') }}">
                    <i class="nav-icon i-File-Clipboard-Text--Image"></i>
                    <span class="item-name">User List</span>
                </a>
            </li>
        </ul>
        <ul class="childNav" data-parent="forms">
            <li class="nav-item">
                <a href="{{ route('vendor.create') }}">
                    <i class="nav-icon i-File-Clipboard-Text--Image"></i>
                    <span class="item-name">Add New Vendor</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="{{ Route::currentRouteName() == 'vendorlist' ? 'open' : '' }}"
                    href="{{ route('vendorlist') }}">
                    <i class="nav-icon i-File-Clipboard-Text--Image"></i>
                    <span class="item-name">Vendor List</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="{{ Route::currentRouteName() == 'withdrawl' ? 'open' : '' }}"
                    href="{{ route('withdrawl') }}">
                    <i class="nav-icon i-Split-Vertical"></i>
                    <span class="item-name">Vendor Withdrawls</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="{{ Route::currentRouteName() == 'withdrawl' ? 'open' : '' }}"
                    href="{{ route('withdrawl') }}">
                    <i class="nav-icon i-Split-Vertical"></i>
                    <span class="item-name">Withdrawal Methods</span>
                </a>
            </li>
        </ul>

        <ul class="childNav" data-parent="widgets">
            <li class="nav-item">
                <a class="{{ Route::currentRouteName() == 'allmenu' ? 'open' : '' }}"
                    href="{{ route('allmenu') }}">
                    <i class="nav-icon i-Blinklist"></i>
                    <span class="item-name">All Menus</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="{{ Route::currentRouteName() == 'addmenu' ? 'open' : '' }}"
                    href="{{ route('addmenu') }}">
                    <i class="nav-icon i-Blinklist"></i>
                    <span class="item-name">Add Menus</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="{{ Route::currentRouteName() == 'allcat' ? 'open' : '' }}"
                    href="{{ route('allcat') }}">
                    <i class="nav-icon i-Folder"></i>
                    <span class="item-name">All Categories</span>
                </a>
            </li>

            <li class="nav-item">


                <a class="{{ Route::currentRouteName() == 'allsubcat' ? 'open' : '' }}"
                    href="{{ route('allsubcat') }}">
                    <i class="nav-icon i-Folder-Open"></i>
                    <span class="item-name">All Sub Categories</span>
                </a>
            </li>

            {{-- might be used furtuer for alert messages  --}}

            {{-- <li class="nav-item">
                <a class="{{ Route::currentRouteName() == 'widget-weather-app' ? 'open' : '' }}"
                    href="{{ route('widget-weather-app') }}">
                    <i class="nav-icon i-Receipt-4"></i>
                    <span class="item-name"> Weather App <span class="ms-2 badge badge-pill text-bg-danger">
                            New</span>
                    </span>
                </a>
            </li> --}}

        </ul>
        <ul class="childNav" data-parent="apps">
            <li class="nav-item">
                <a class="{{ Route::currentRouteName() == 'customerlist' ? 'open' : '' }}" href="{{ route('customerlist') }}">
                    <i class="nav-icon i-Resize"></i>
                    <span class="item-name">Customer List</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="{{ Route::currentRouteName() == 'creviews' ? 'open' : '' }}" href="{{ route('creviews') }}">
                    <i class="nav-icon i-Add"></i>
                    <span class="item-name">Customer Reviews</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="{{ Route::currentRouteName() == 'cwallet' ? 'open' : '' }}" href="{{ route('cwallet') }}">
                    <i class="nav-icon i-Shopping-Bag"></i>
                    <span class="item-name">Wallet</span>
                </a>
            </li>
        </ul>

        <ul class="childNav" data-parent="charts">
                <li class="nav-item">
                    <a class="{{ Route::currentRouteName() == 'products' ? 'open' : '' }}" href="{{ route('products.create') }}">
                        <i class="nav-icon i-Add"></i>
                        <span class="item-name">Add Product</span>
                    </a>
                </li>
            <li class="nav-item">
                <a class="{{ Route::currentRouteName() == 'allproducts' ? 'open' : '' }}" href="{{ route('allproducts') }}">
                    <i class="nav-icon i-Shopping-Bag"></i>
                    <span class="item-name">All Product</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="{{ Route::currentRouteName() == 'customerqueries' ? 'open' : '' }}" href="{{ route('customerqueries') }}">
                    <i class="nav-icon i-Pen-2"></i>
                    <span class="item-name">Customer Queries</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="{{ Route::currentRouteName() == 'productinfo' ? 'open' : '' }}" href="{{ route('productinfo') }}">
                    <i class="nav-icon i-Arrow-Circle"></i>
                    <span class="item-name">Product Info</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="{{ Route::currentRouteName() == 'productreviews' ? 'open' : '' }}" href="{{ route('productreviews') }}">
                    <i class="nav-icon i-David-Star"></i>
                    <span class="item-name">Product Reviews</span>
                </a>
            </li>

        </ul>
                <ul class="childNav" data-parent="extrakits">

           <li class="nav-item">
                <a class="{{ Route::currentRouteName() == 'createrefund' ? 'open' : '' }}"
                    href="{{ route('createrefund') }}">
                    <i class="nav-icon i-Arrow-Down-in-Circle"></i>
                    <span class="item-name">Create Refund</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="{{ Route::currentRouteName() == 'allrefunds' ? 'open' : '' }}"
                    href="{{ route('allrefunds') }}">
                    <i class="nav-icon i-Arrow-Down-in-Circle"></i>
                    <span class="item-name">All Refunds`</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="{{ Route::currentRouteName() == 'pendingrefund' ? 'open' : '' }}"
                    href="{{ route('pendingrefund') }}">
                    <i class="nav-icon i-Arrow-Down-in-Circle"></i>
                    <span class="item-name">Pending</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="{{ Route::currentRouteName() == 'approvedrefund' ? 'open' : '' }}"
                    href="{{ route('approvedrefund') }}">
                    <i class="nav-icon i-Approved-Window"></i>
                    <span class="item-name">Approved</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="{{ Route::currentRouteName() == 'refunded' ? 'open' : '' }}" href="{{ route('refunded') }}">
                    <i class="nav-icon i-Loading-3"></i>
                    <span class="item-name">Refunded</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="{{ Route::currentRouteName() == 'refundrejected' ? 'open' : '' }}"
                    href="{{ route('refundrejected') }}">
                    <i class="nav-icon i-Stop"></i>
                    <span class="item-name">Rejected</span>
                </a>
            </li>
        </ul>
        <ul class="childNav" data-parent="uikits">
            <li class="nav-item">
                <a class="{{ Route::currentRouteName() == 'allorders' ? 'open' : '' }}" href="{{ route('allorders') }}">
                    <i class="nav-icon i-Folder-Archive"></i>
                    <span class="item-name">ALL</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="{{ Route::currentRouteName() == 'pendingorders' ? 'open' : '' }}" href="{{ route('pendingorders') }}">
                    <i class="nav-icon i-Clock"></i>
                    <span class="item-name">Pending</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="{{ Route::currentRouteName() == 'confirmedorders' ? 'open' : '' }}" href="{{ route('confirmedorders') }}">
                    <i class="nav-icon i-Checkout"></i>
                    <span class="item-name">Confirmed</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="{{ Route::currentRouteName() == 'packagingorders' ? 'open' : '' }}" href="{{ route('packagingorders') }}">
                    <i class="nav-icon i-Safe-Box"></i>
                    <span class="item-name">Packaging</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="{{ Route::currentRouteName() == 'outofdelivery' ? 'open' : '' }}" href="{{ route('outofdelivery') }}">
                    <i class="nav-icon i-Arrow-Circle"></i>
                    <span class="item-name">Out of Delivery</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="{{ Route::currentRouteName() == 'delivered' ? 'open' : '' }}" href="{{ route('delivered') }}">
                    <i class="nav-icon i-Check"></i>
                    <span class="item-name">Delivered</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="{{ Route::currentRouteName() == 'returned' ? 'open' : '' }}" href="{{ route('returned') }}">
                    <i class="nav-icon i-Redo"></i>
                    <span class="item-name">Returned</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="{{ Route::currentRouteName() == 'ftod' ? 'open' : '' }}" href="{{ route('ftod') }}">
                    <i class="nav-icon i-Over-Time-2"></i>
                    <span class="item-name">Failed to Deliver</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="{{ Route::currentRouteName() == 'canceled' ? 'open' : '' }}" href="{{ route('canceled') }}">
                    <i class="nav-icon i-File-Trash"></i>
                    <span class="item-name">Canceled</span>
                </a>
            </li>
        </ul>
        <ul class="childNav" data-parent="sessions">
            <li class="nav-item">
                <a class="{{ Route::currentRouteName() == 'coupon.create' ? 'open' : '' }}" href="{{ route('coupon.create') }}" >
                    <i class="nav-icon i-File-Trash"></i>
                    <span class="item-name">Create Coupon</span>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('signUp') }}">
                    <i class="nav-icon i-Zootool"></i>
                    <span class="item-name">All Services</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('forgot') }}">
                    <i class="nav-icon i-Quotes"></i>
                    <span class="item-name">Testimonials</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('forgot') }}">
                    <i class="nav-icon i-Bar-Chart"></i>
                    <span class="item-name">Skills</span>
                </a>
            </li>
        </ul>
        <ul class="childNav" data-parent="others">
            <li class="nav-item">
                <a href="{{ route('notFound') }}">
                    <i class="nav-icon i-Add"></i>
                    <span class="item-name">Add Purchase</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="{{ Route::currentRouteName() == 'pricing-table' ? 'open' : '' }}"
                    href="{{ route('pricing-table') }}">
                    <i class="nav-icon i-Gears"></i>
                    <span class="item-name">All Purchases
                        {{-- <span class="ms-2 badge badge-pill text-bg-danger">New</span></span> --}}
                </a>
            </li>

            <li class="nav-item">
                <a class="{{ Route::currentRouteName() == 'search-result' ? 'open' : '' }}"
                    href="{{ route('search-result') }}">
                    <i class="nav-icon i-Settings-Window"></i>
                    <span class="item-name">Home Setting
                        {{-- <span class="badge badge-pill text-bg-danger">New</span></span> --}}
                </a>
            </li>
            <li class="nav-item">
                <a class="{{ Route::currentRouteName() == 'user-profile' ? 'open' : '' }}"
                    href="{{ route('user-profile') }}">
                    <i class="nav-icon i-Gear-2"></i>
                    <span class="item-name">Blog Setting</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="{{ Route::currentRouteName() == 'faq' ? 'open' : '' }}" href="{{ route('faq') }}"
                    class="open">
                    <i class="nav-icon i-File-Text--Image"></i>
                    <span class="item-name">Home Banner</span>
                </a>
            </li>
            {{-- <li class="nav-item">
                <a class="{{ Route::currentRouteName() == 'starter' ? 'open' : '' }}" href="{{ route('starter') }}"
                    class="open">
                    <i class="nav-icon i-File-Horizontal"></i>
                    <span class="item-name">Blank Page</span>
                </a>
            </li> --}}
        </ul>
    </div>
    <div class="sidebar-overlay"></div>
<!--=============== Left side End ================-->

