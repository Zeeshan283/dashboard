<ul class="navigation-left">
    @if (auth()->check())
    {{-- @if (auth()->check() && auth()->user()->roles->contains('name', 'vendorOnly')) --}}
        <li class="nav-item {{ request()->is('charts/*') ? 'active' : '' }}" data-item="charts">
            {{-- <a class="nav-item-hold" href="#"> --}}
                <a class="nav-item-hold {{ auth()->user()->roles->contains('name', 'vendor') ? '' : 'disabled' }}" href="#">
                <i class="nav-icon i-Shopping-Bag"></i>
                <span class="nav-text">Products</span>
            </a>
        </li>
    @else
        <li class="nav-item">
            <a href="javascript:void(0);" class="disabled"></a>
            <div class="triangle"></div>
        </li>
        @endif
</ul>
