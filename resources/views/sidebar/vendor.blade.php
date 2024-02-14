<ul class="navigation-left">
    <li class="nav-item {{ request()->is('dashboard/*') ? 'active' : '' }}">
        <a class="nav-item-hold" href="{{ route('admin') }}">
            <i class="nav-icon i-Bar-Chart"></i>
            <span class="nav-text">Dashboard</span>
        </a>
    </li>
    <li class="nav-item {{ request()->is('charts/*') ? 'active' : '' }}" data-item="charts">
        {{-- <a class="nav-item-hold {{ $Vendor ? '' : 'disabled' }}" href="{{ $Vendor ? route('products.create') : '#' }}"> --}}
        <a class="nav-item-hold" href="#">
            <i class="nav-icon i-Shopping-Bag"></i>
            <span class="nav-text">Products</span>
        </a>
    </li>
    <li class="nav-item {{ request()->is('uikits/*') ? 'active' : '' }}" data-item="uikits">
        <a class="nav-item-hold" href="#">
            <i class="nav-icon i-Shopping-Cart"></i>
            <span class="nav-text">Orders</span>
        </a>
    </li>

    
    <li class="nav-item {{ request()->is('sales/*') ? 'active' : '' }}" data-item="sales">
        <a class="nav-item-hold" href="#">
            <i class="nav-icon i-Dollar-Sign"></i>
            <span class="nav-text">Sales</span>
        </a>
    </li>
    <li class="nav-item {{ request()->is('purchase/*') ? 'active' : '' }}" data-item="purchase">
        <a class="nav-item-hold" href="#">
            <i class="nav-icon i-Film-Cartridge"></i>
            <span class="nav-text">Purchase</span>
        </a>
    </li>
    <li class="nav-item {{ request()->is('sessions/*') ? 'active' : '' }}" data-item="sessions">
        <a class="nav-item-hold" href="/test.html">
            <i class="nav-icon i-Tag-4"></i>
            <span class="nav-text">Coupon</span>
        </a>
        {{-- <div class="triangle"></div> --}}
    </li>
    


    <li class="nav-item {{ request()->is('ewallet/*') ? 'active' : '' }}" data-item="ewallet">
        <a class="nav-item-hold" href="#">
            <i class="nav-icon i-Money"></i>
            <span class="nav-text">EWallet</span>
        </a>
    </li>

    <li class="nav-item " data-item="uikits2">
        <a class="nav-item-hold" href="/test.html">
            <i class="nav-icon i-Library"></i>
            <span class="nav-text">Advertisement</span>
        </a>
        {{-- <div class="triangle"></div> --}}
    </li>
    <li class="nav-item {{ request()->is('sessions/*') ? 'active' : '' }}" data-item="accountdetails">
        <a class="nav-item-hold" href="#">
            <i class="nav-icon i-Find-User"></i>
            <span class="nav-text">Account Details</span>
        </a>
        {{-- <div class="triangle"></div> --}}
    </li>
