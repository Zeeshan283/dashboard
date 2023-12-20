<div class="side-content-wrap">
    <div class="sidebar-left open rtl-ps-none" data-perfect-scrollbar data-suppress-scroll-x="true">
        <ul class="navigation-left">
            @if (Auth::User()->role == 'Admin')
                @include('sidebar.admin')
            @elseif (Auth::User()->role == 'Vendor')
                @include('sidebar.vendor')
            @endif
        </ul>

    </div>

    <div class="sidebar-left-secondary rtl-ps-none" data-perfect-scrollbar data-suppress-scroll-x="true">

        <ul class="childNav" data-parent="users">

            <li class="nav-item">
                <a class="{{ Route::currentRouteName() == 'user.add' ? 'open' : '' }}" href="{{ route('user.add') }}">
                    <i class="nav-icon i-Add"></i>
                    <span class="item-name">Add New User</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="{{ Route::currentRouteName() == 'userlist' ? 'open' : '' }}" href="{{ route('userlist') }}">
                    <i class="nav-icon i-Male"></i>
                    <span class="item-name">User List</span>
                </a>
            </li>
        </ul>
        <ul class="childNav" data-parent="purchase">

            <li class="nav-item">
                <a class="{{ Route::currentRouteName() == 'purchase.create' ? 'open' : '' }}"
                    href="{{ route('purchase.create') }}">
                    <i class="nav-icon i-Add"></i>
                    <span class="item-name">Add Purchase</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="{{ Route::currentRouteName() == 'supplier.index' ? 'open' : '' }}"
                    href="{{ route('supplier.index') }}">
                    <i class="nav-icon i-File-Clipboard-Text--Image"></i>
                    <span class="item-name">Add Supplier</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="{{ Route::currentRouteName() == 'purchase.index' ? 'open' : '' }}"
                    href="{{ route('purchase.index') }}">
                    <i class="nav-icon i-File-Clipboard-Text--Image"></i>
                    <span class="item-name">Stock </span>
                </a>
            </li>

            <li class="nav-item">
                <a class="{{ Route::currentRouteName() == 'purchaseHistory' ? 'open' : '' }}"
                    href="{{ route('purchaseHistory') }}">
                    <i class="nav-icon i-File-Clipboard-Text--Image"></i>
                    <span class="item-name">Purchase History</span>
                </a>
            </li>



        </ul>
        <ul class="childNav" data-parent="forms">
            <li class="nav-item">
                <a class="{{ Route::currentRouteName() == 'vendor.create' ? 'open' : '' }}"
                    href="{{ route('vendor.create') }}">
                    <i class="nav-icon i-Add"></i>
                    <span class="item-name">Add New Vendor</span>
                </a>
            </li>



            <li class="nav-item">
                <a class="{{ Route::currentRouteName() == 'vendor.index' ? 'open' : '' }}"
                    href="{{ route('vendor.index') }}">
                    <i class="nav-icon i-Male"></i>
                    <span class="item-name">Vendor List</span>
                </a>
            </li>
            {{-- <li class="nav-item">
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
            </li> --}}
        </ul>

        <ul class="childNav" data-parent="ewallet">
            <li class="nav-item">
                <a class="{{ Route::currentRouteName() == 'collectedcash' ? 'open' : '' }}"
                    href="{{ route('collectedcash') }}">
                    <i class="nav-icon i-Folder-Archive"></i>
                    <span class="item-name">Collected Cash</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="{{ Route::currentRouteName() == 'Totalbuying' ? 'open' : '' }}"
                    href="{{ route('Totalbuying') }}">
                    <i class="nav-icon i-Clock"></i>
                    <span class="item-name">Total Buying</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="{{ Route::currentRouteName() == 'totalrefund' ? 'open' : '' }}"
                    href="{{ route('totalrefund') }}">
                    <i class="nav-icon i-Checkout"></i>
                    <span class="item-name">Total Refunds</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="{{ Route::currentRouteName() == 'totalwithdrawl' ? 'open' : '' }}"
                    href="{{ route('totalwithdrawl') }}">
                    <i class="nav-icon i-Safe-Box"></i>
                    <span class="item-name">Total Withdrawals</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="{{ Route::currentRouteName() == 'transcationhistory' ? 'open' : '' }}"
                    href="{{ route('transcationhistory') }}">
                    <i class="nav-icon i-Arrow-Circle"></i>
                    <span class="item-name">Transaction History</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="{{ Route::currentRouteName() == 'totalpendingwithdrawls' ? 'open' : '' }}"
                    href="{{ route('totalpendingwithdrawls') }}">
                    <i class="nav-icon i-Check"></i>
                    <span class="item-name">Total Pending withdrawn</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="{{ Route::currentRouteName() == 'totalspendondeals' ? 'open' : '' }}"
                    href="{{ route('totalspendondeals') }}">
                    <i class="nav-icon i-Redo"></i>
                    <span class="item-name">Total Spent on Offer & Deals</span>
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

            <li class="nav-item">
                <a class="{{ Route::currentRouteName() == 'paymentmethod' ? 'open' : '' }}"
                    href="{{ route('paymentmethod') }}">
                    <i class="nav-icon i-File-Trash"></i>
                    <span class="item-name">Payments</span>
                </a>
            </li>
        </ul>


        <ul class="childNav" data-parent="widgets">
            <li class="nav-item">
                <a class="{{ Route::currentRouteName() == 'allmenu' ? 'open' : '' }}" href="{{ route('allmenu') }}">
                    <i class="nav-icon i-Blinklist"></i>
                    <span class="item-name">All Menus</span>
                </a>
            </li>


            <li class="nav-item">

                <a class="{{ Route::currentRouteName() == 'allcat' ? 'open' : '' }}" href="{{ route('allcat') }}">
                    <i class="nav-icon i-Folder"></i>
                    <span class="item-name">All Categories</span>
                </a>
            </li>

            <li class="nav-item">

                {{-- <a class="{{ Route::currentRouteName() == 'allsubcat' ? 'open' : '' }}"
                    href="{{ route('allsubcat') }}"> --}}
                <a href="{{ url('/sub-category') }}" id="list-item-color"
                    class="nav-link menu-link {{ Route::currentRouteName() == 'sub-category.index' ? 'open' : '' }}">
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
                <a class="{{ Route::currentRouteName() == 'customerlist' ? 'open' : '' }}"
                    href="{{ route('customerlist') }}">
                    <i class="nav-icon i-Resize"></i>
                    <span class="item-name">Customer List</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="{{ Route::currentRouteName() == 'creviews' ? 'open' : '' }}"
                    href="{{ route('creviews') }}">
                    <i class="nav-icon i-Add"></i>
                    <span class="item-name">Customer Reviews</span>
                </a>
            </li>
            {{-- <li class="nav-item">
                <a class="{{ Route::currentRouteName() == 'cwallet' ? 'open' : '' }}" href="{{ route('cwallet') }}">
                    <i class="nav-icon i-Shopping-Bag"></i>
                    <span class="item-name">Wallet</span>
                </a>
            </li> --}}
        </ul>

        <ul class="childNav" data-parent="charts">
            <li class="nav-item">
                <a class="{{ Route::currentRouteName() == 'products.create' ? 'open' : '' }}"
                    href="{{ route('products.create') }}">
                    <i class="nav-icon i-Add"></i>
                    <span class="item-name">Add Product</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="{{ Route::currentRouteName() == 'products.index' ? 'open' : '' }}"
                    href="{{ route('products.index') }}">
                    <i class="nav-icon i-Shopping-Bag"></i>
                    <span class="item-name">All Product</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="{{ Route::currentRouteName() == 'CustomerQueries.index' ? 'open' : '' }}"
                    href="{{ route('CustomerQueries.index') }}">
                    <i class="nav-icon i-Pen-2"></i>
                    <span class="item-name">Customer Queries</span>
                </a>
            </li>
            {{-- <li class="nav-item">
                <a class="{{ Route::currentRouteName() == 'productinfo' ? 'open' : '' }}" href="{{ route('productinfo') }}">
                    <i class="nav-icon i-Arrow-Circle"></i>
                    <span class="item-name">Product Info</span>
                </a>
            </li> --}}
            <li class="nav-item">
                <a class="{{ Route::currentRouteName() == 'productreviews' ? 'open' : '' }}"
                    href="{{ route('productreviews') }}">
                    <i class="nav-icon i-David-Star"></i>
                    <span class="item-name">Product Reviews</span>
                </a>
            </li>

        </ul>
        <ul class="childNav" data-parent="extrakits">

            <li class="nav-item">
                <a class="{{ Route::currentRouteName() == 'createrefund' ? 'open' : '' }}"
                    href="{{ route('createrefund') }}">
                    <i class="nav-icon i-Add"></i>
                    <span class="item-name">Create Refund</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="{{ Route::currentRouteName() == 'allrefunds' ? 'open' : '' }}"
                    href="{{ route('allrefunds') }}">
                    <i class="nav-icon i-Arrow-Down-in-Circle"></i>
                    <span class="item-name">All Refunds</span>
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
                <a class="{{ Route::currentRouteName() == 'refunded' ? 'open' : '' }}"
                    href="{{ route('refunded') }}">
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
                <a class="{{ Route::currentRouteName() == 'allorders' ? 'open' : '' }}"
                    href="{{ route('allorders') }}">
                    <i class="nav-icon i-Folder-Archive"></i>
                    <span class="item-name">ALL Orders</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="{{ Route::currentRouteName() == 'pendingorders' ? 'open' : '' }}"
                    href="{{ route('pendingorders') }}">
                    <i class="nav-icon i-Clock"></i>
                    <span class="item-name">Pending</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="{{ Route::currentRouteName() == 'confirmedorders' ? 'open' : '' }}"
                    href="{{ route('confirmedorders') }}">
                    <i class="nav-icon i-Checkout"></i>
                    <span class="item-name">Confirmed</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="{{ Route::currentRouteName() == 'packagingorders' ? 'open' : '' }}"
                    href="{{ route('packagingorders') }}">
                    <i class="nav-icon i-Safe-Box"></i>
                    <span class="item-name">Packaging</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="{{ Route::currentRouteName() == 'outofdelivery' ? 'open' : '' }}"
                    href="{{ route('outofdelivery') }}">
                    <i class="nav-icon i-Arrow-Circle"></i>
                    <span class="item-name">Out of Delivery</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="{{ Route::currentRouteName() == 'delivered' ? 'open' : '' }}"
                    href="{{ route('delivered') }}">
                    <i class="nav-icon i-Check"></i>
                    <span class="item-name">Delivered</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="{{ Route::currentRouteName() == 'returned' ? 'open' : '' }}"
                    href="{{ route('returned') }}">
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
                <a class="{{ Route::currentRouteName() == 'canceled' ? 'open' : '' }}"
                    href="{{ route('canceled') }}">
                    <i class="nav-icon i-File-Trash"></i>
                    <span class="item-name">Canceled</span>
                </a>
            </li>
        </ul>
        <ul class="childNav" data-parent="sessions">
            <li class="nav-item">
                <a class="{{ Route::currentRouteName() == 'coupon.create' ? 'open' : '' }}"
                    href="{{ route('coupon.create') }}">
                    <i class="nav-icon i-Add"></i>
                    <span class="item-name">Create Coupon</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="{{ Route::currentRouteName() == 'coupon.index' ? 'open' : '' }}"
                    href="{{ route('coupon.index') }}">
                    <i class="nav-icon i-File-Trash"></i>
                    <span class="item-name">All Coupon</span>
                </a>
            </li>



        </ul>
        <ul class="childNav" data-parent="others">
            <li class="nav-item">
                <a href="#">
                    <i class="nav-icon i-Add"></i>
                    <span class="item-name">Add Purchase</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="{{ Route::currentRouteName() == 'pricing-table' ? 'open' : '' }}" href="#) }}">
                    <i class="nav-icon i-Gears"></i>
                    <span class="item-name">Stock
                        {{-- <span class="ms-2 badge badge-pill text-bg-danger">New</span></span> --}}
                </a>
            </li>

        </ul>
        <ul class="childNav" data-parent="terms">
            <li class="nav-item">
                <a class="{{ Route::currentRouteName() == 'banners.index' ? 'open' : '' }}"
                    href="{{ route('banners.index') }}">
                    <i class="nav-icon i-Blinklist"></i>
                    <span class="item-name">Home Banners</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="{{ Route::currentRouteName() == 'home-settings' ? 'open' : '' }}"
                    href="{{ route('home-settings') }}">
                    <i class="nav-icon i-Blinklist"></i>
                    <span class="item-name">Home Settings</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="{{ Route::currentRouteName() == 'brands.index' ? 'open' : '' }}"
                    href="{{ route('brands.index') }}">
                    <i class="nav-icon i-Blinklist"></i>
                    <span class="item-name">Brands</span>
                </a>
            </li>




            <li class="nav-item">
                <a class="{{ Route::currentRouteName() == 'payment_method' ? 'open' : '' }}"
                    href="{{ route('payment_method.index') }}">
                    <i class="nav-icon i-Billing"></i>
                    <span class="item-name">Payment Method</span>
                </a>
            </li>


            <li class="nav-item">
                <a class="{{ Route::currentRouteName() == '' ? 'open' : '' }}"
                    href="{{ URL::to('settings/1/edit') }}">
                    <i class="nav-icon i-Male"></i>
                    <span class="item-name">Site Profile</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="{{ Route::currentRouteName() == 'Deals.index' ? 'open' : '' }}"
                    href="{{ route('Deals.index') }}">
                    <i class="nav-icon i-Shopping-Bag"></i>
                    <span class="item-name">Deal's Day</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="{{ Route::currentRouteName() == 'emails.index' ? 'open' : '' }}"
                    href="{{ route('emails.index') }}">
                    <i class="nav-icon i-Shopping-Bag"></i>
                    <span class="item-name">Email Page</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="{{ Route::currentRouteName() == 'Homecoupons.index' ? 'open' : '' }}"
                    href="{{ route('Homecoupons.index') }}">
                    <i class="nav-icon i-File-Trash"></i>
                    <span class="item-name">Home Page Coupon</span>
                </a>
            </li>

        </ul>

        <ul class="childNav" data-parent="profile">
            <li class="nav-item">
                <a class="{{ Route::currentRouteName() == 'vendor-profile' && Auth::user()->role == 'Vendor' ? 'open' : '' }}"
                    href="{{ URL::to('vendor-profile/' . Auth::user()->id) }}">
                    <i class="nav-icon i-Male"></i>
                    <span class="item-name">Profile</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="{{ Route::currentRouteName() == 'verified-seller' && Auth::user()->role == 'Vendor' ? 'open' : '' }}"
                    href="{{ URL::to('verified-seller/' . Auth::user()->id) }}">
                    <i class="nav-icon i-Male"></i>
                    <span class="item-name">Become A Verified</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="{{ Route::currentRouteName() == 'cprofile.index' ? 'open' : '' }}"
                    href="{{ route('cprofile.index') }}">
                    <i class="nav-icon i-File-Trash"></i>
                    <span class="item-name">Services</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="{{ Route::currentRouteName() == 'service.index' ? 'open' : '' }}"
                    href="{{ route('service.index') }}">
                    <i class="nav-icon i-File-Trash"></i>
                    <span class="item-name">Service Category</span>
                </a>
            </li>
        </ul>


        <ul class="childNav" data-parent="uikits1">



            <li class="nav-item">
                <a class="{{ Route::currentRouteName() == 'advertisements.create' ? 'open' : '' }}"
                    href="{{ route('advertisements.create') }}">
                    <i class="nav-icon i-Add"></i>
                    <span class="item-name">Create Advertisement</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="{{ Route::currentRouteName() == 'advertisements.index' ? 'open' : '' }}"
                    href="{{ route('advertisements.index') }}">
                    <i class="nav-icon i-Approved-Window"></i>
                    <span class="item-name">Advertisement</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="{{ Route::currentRouteName() == 'advertisementSellers.details' ? 'open' : '' }}"
                    href="{{ route('advertisementSellers.details') }}">
                    <i class="nav-icon i-File-Clipboard-Text--Image"></i>
                    <span class="item-name">Advertisement Order</span>
                </a>
            </li>

        </ul>

        <ul class="childNav" data-parent="uikits2">

            <li class="nav-item">
                <a class="{{ Route::currentRouteName() == 'advertisementSellers.index' ? 'open' : '' }}"
                    href="{{ route('advertisementSellers.index') }}">
                    <i class="nav-icon i-File-Clipboard-Text--Image"></i>
                    <span class="item-name">Advertisement</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="{{ Route::currentRouteName() == 'advertisementSellers.ASDetails' ? 'open' : '' }}"
                    href="{{ route('advertisementSellers.ASDetails') }}">
                    <i class="nav-icon i-File-Clipboard-Text--Image"></i>
                    <span class="item-name">Order
                        Details</span>
                </a>
            </li>

        </ul>


        <ul class="childNav" data-parent="pages">
            <li class="nav-item">

                <a class="{{ Route::currentRouteName() == 'pages.index' ? 'open' : '' }}"
                    href="{{ route('pages.index') }}">
                    <i class="nav-icon i-File-Horizontal"></i>
                    <span class="item-name">Page's</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="{{ Route::currentRouteName() == 'faqs_categories.index' ? 'open' : '' }}"
                    href="{{ route('faqs_categories.index') }}">
                    <i class="nav-icon i-File-Horizontal"></i>
                    <span class="item-name">Faq Category</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="{{ Route::currentRouteName() == 'faqs.index' ? 'open' : '' }}"
                    href="{{ route('faqs.index') }}">
                    <i class="nav-icon i-File-Horizontal"></i>
                    <span class="item-name">FAQ's</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="{{ Route::currentRouteName() == 'allterm' ? 'open' : '' }}"
                    href="{{ route('allterm') }}">
                    <i class="nav-icon i-Blinklist"></i>
                    <span class="item-name">Terms & Conditions</span>
                </a>
            </li>
        </ul>
        <ul class="childNav" data-parent="blogs">
            <li class="nav-item">
                <a href="{{ route('blog_categories.index') }}">
                    <i class="nav-icon i-Add"></i>
                    <span class="item-name">Blog Category</span>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('blog_subcategories.index') }}">
                    <i class="nav-icon i-Add"></i>
                    <span class="item-name">Blog SubCategory</span>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('blogs.index') }}">
                    <i class="nav-icon i-File-Clipboard-Text--Image"></i>
                    <span class="item-name">Blog List</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('cfeatures.index') }}">
                    <i class="nav-icon i-File-Clipboard-Text--Image"></i>
                    <span class="item-name">Training Page</span>
                </a>
            </li>
        </ul>

    </div>
    <div class="sidebar-overlay"></div>
    <!--=============== Left side End ================-->
