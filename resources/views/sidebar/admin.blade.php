
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
    <li class="nav-item {{ request()->is('addseller/*') ? 'active' : '' }}" data-item="forms">
        <a class="nav-item-hold" href="#">
            <i class="nav-icon i-File-Clipboard-File--Text"></i>
            <span class="nav-text">All Sellers</span>
        </a>
    </li>
<li class="nav-item {{ request()->is('extrakits/*') ? 'active' : '' }}" data-item="extrakits">
    <a class="nav-item-hold" href="#">
        <i class="nav-icon i-Money"></i>
        <span class="nav-text">Refund Request</span>

    </a>
    <div class="triangle"></div>
</li>
<li class="nav-item {{ request()->is('uikits/*') ? 'active' : '' }}" data-item="uikits">
    <a class="nav-item-hold" href="#">
        <i class="nav-icon i-Shopping-Cart"></i>
        <span class="nav-text">Orders</span>
    </a>
</li>
<li class="nav-item {{ request()->is('charts/*') ? 'active' : '' }}" data-item="charts">
        <a class="nav-item-hold" href="#">
        <i class="nav-icon i-Shopping-Bag"></i>
        <span class="nav-text">Products</span>
    </a>
</li>
<li class="nav-item {{ request()->is('purchase/*') ? 'active' : '' }}" data-item="purchase">
        <a class="nav-item-hold" href="#">
        <i class="nav-icon i-Film-Cartridge"></i>
        <span class="nav-text">Purchase</span>
    </a>
</li>
<li class="nav-item {{ request()->is('uikits/*') ? 'active' : '' }}" data-item="uikits">
    <a class="nav-item-hold" href="#">
        <i class="nav-icon i-Shopping-Cart"></i>
        <span class="nav-text">Orders</span>
    </a>
</li>
<li class="nav-item {{ request()->is('sessions/*') ? 'active' : '' }}" data-item="sessions">
    <a class="nav-item-hold" href="/test.html">
        <i class="nav-icon i-Information"></i>
        <span class="nav-text">Coupon</span>
    </a>
    <div class="triangle"></div>
</li>

<li class="nav-item {{ request()->is('apps/*') ? 'active' : '' }}" data-item="apps">
    <a class="nav-item-hold" href="#">
        <i class="nav-icon i-Computer-Secure"></i>
        <span class="nav-text">Customers</span>

    </a>
    <div class="triangle"></div>
</li>
<li class="nav-item {{ request()->is('widgets/*') ? 'active' : '' }}" data-item="widgets">
    <a class="nav-item-hold" href="#">
        <i class="nav-icon i-Windows-2"></i>
        <span class="nav-text">Categories</span>

    </a>
    <div class="triangle"></div>
</li>
<li class="nav-item {{ request()->is('sessions/*') ? 'active' : '' }}" data-item="sessions">
    <a class="nav-item-hold" href="/test.html">
        <i class="nav-icon i-Information"></i>
        <span class="nav-text">Coupon</span>
    </a>
    <div class="triangle"></div>
</li>

<li class="nav-item {{ request()->is('users/*') ? 'active' : '' }}" data-item="users">
    <a class="nav-item-hold" href="/test.html">
        <i class="nav-icon i-Find-User"></i>
        <span class="nav-text">Users</span>
    </a>
    <div class="triangle"></div>
</li>

<li class="nav-item {{ request()->is('terms/*') ? 'active' : '' }}" data-item="terms">
    <a class="nav-item-hold" href="/test.html">
        <i class="nav-icon i-Windows-2"></i>
        <span class="nav-text">Terms</span>
    </a>
    <div class="triangle"></div>
</li>
</ul>

