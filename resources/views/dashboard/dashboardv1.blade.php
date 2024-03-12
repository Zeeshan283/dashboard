@extends('layouts.master')

@section('page-css')
    <link rel="stylesheet" href="{{ asset('assets/styles/vendor/apexcharts.css') }}">
@endsection

@section('main-content')
    <div class="breadcrumb">
        {{-- <h1><a href="{{ route('admin') }}">Admin Dashboard </a></h1> --}}
        <h3>
            @if (Auth::user()->role == 'Admin')
                Admin Dashboard
            @else
                Vendor Dashboard
            @endif

            {{-- <small>Bigdeal Admin panel</small> --}}
        </h3>
        @if (Auth::user()->role == 'Vendor')
            @if (Auth::user()->status == '1')
                <span class="btn btn-primary">Status: Active</span>
            @else
                <span class="btn btn-secondary">Status: In Active </span> ( Your profile is pending for
                approval)
            @endif
        @endif
    </div>

    <div class="separator-breadcrumb border-top"></div>

    <div class="row">
        <!-- ICON BG -->
        <div class="col-lg-2">
            <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                <div class="card-body text-center">
                    <i class="i-Shopping-Bag"></i>
                    <div class="content">
                        <p class="text-muted mt-2 mb-0">TotalSales($)</p>
                        <p class="text-primary text-24 line-height-1 mb-2">{{ $totalOrders }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-2">
            <a href="{{ route('products.index') }}">
                <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                    <div class="card-body text-center">
                        <i class="i-Add-Cart"></i>
                        <div class="content">
                            <p class="text-muted mt-2 mb-0">TotalProducts</p>
                            <p class="text-primary text-24 line-height-1 mb-2">{{ $products }}</p>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-lg-2">
            <a href="{{ route('allorders') }}">
                <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                    <div class="card-body text-center">
                        <i class="i-Shopping-Cart"></i>
                        <div class="content">
                            <p class="text-muted mt-2 mb-0">TotalOrders</p>
                            <p class="text-primary text-24 line-height-1 mb-2">{{ $currenOrders }}</p>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-3">
            <a href="{{ route('pendingorders') }}">
                <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                    <div class="card-body text-center">
                        <i class="i-Clock" style="height: 30px"></i>
                        <div class="content">
                            <p class="text-muted mt-2 mb-0">TotalPendingOrders</p>
                            <p class="text-primary text-15 line-height-1 mb-2">{{ $pending }}</p>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-lg-3">
            <a href="{{ route('returned') }}">
                <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                    <div class="card-body text-center">
                        <i class="i-Timer1" style="height: 30px"></i>
                        <div class="content">
                            <p class="text-muted mt-2 mb-0">TotalOrdersReturned</p>
                            <p class="text-primary text-15 line-height-1 mb-2">{{ $returned }}</p>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-2">
            <a href="{{ route('canceled') }}">
                <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                    <div class="card-body text-center">
                        <i class="i-Timer1" style="height: 30px"></i>
                        <div class="content">
                            <p class="text-muted mt-2 mb-0">TotalCancledOrder</p>
                            <p class="text-primary text-15 line-height-1 mb-2">{{ $canceled }}</p>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-lg-2">
            <a href="{{ route('customerlist') }}">
                <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                    <div class="card-body text-center">
                        <i class="i-Add-User" style="height: 30px"></i>
                        <div class="content">
                            <p class="text-muted mt-2 mb-0">TotalCustomers</p>
                            <p class="text-primary text-15 line-height-1 mb-2">{{ $customer }}</p>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-lg-2">
            <a href="{{ route('CustomerQueries.index') }}">
                <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                    <div class="card-body text-center">
                        <i class="i-Timer1" style="height: 30px"></i>
                        <div class="content">
                            <p class="text-muted mt-2 mb-0">TotalCustomerQueries</p>
                            <p class="text-primary text-15 line-height-1 mb-2">{{ $customerQueries }}</p>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-lg-3">
            <a href="{{ route('sub-category.index') }}">
                <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                    <div class="card-body text-center">
                        <i class="i-Timer1" style="height: 30px"></i>
                        <div class="content">
                            <p class="text-muted mt-2 mb-0">TotalComissionCharged</p>
                            <p class="text-primary text-15 line-height-1 mb-2"></p>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-lg-3">
            <a href="{{ route('sub-category.index') }}">
                <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                    <div class="card-body text-center">
                        <i class="i-Timer1" style="height: 30px"></i>
                        <div class="content">
                            <p class="text-muted mt-2 mb-0">TotalTaxChargedbySuppliers </p>
                            <p class="text-primary text-15 line-height-1 mb-2"></p>
                        </div>
                    </div>
                </div>
            </a>
        </div>

    </div>
    @if (Auth::User()->role == 'Admin')
        <div class="row">
            <div class="col-lg-2">
                <a href="{{ route('delivered') }}">
                    <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                        <div class="card-body text-center">
                            <i class="i-Check" style="height: 30px"></i>
                            <div class="content">
                                <p class="text-muted mt-2 mb-0">TotalCompletedOrders</p>
                                <p class="text-primary text-15 line-height-1 mb-2">{{ $delivered }}</p>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <!-- ICON BG -->
            <div class="col-lg-2">
                <a href="{{ route('vendors.index') }}">
                    <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                        <div class="card-body text-center">
                            <i class="i-Add-User" style="height: 30px"></i>
                            <div class="content">
                                <p class="text-muted mt-2 mb-0">TotalSuppliers</p>
                                <p class="text-primary text-15 line-height-1 mb-2">{{ $vendorlist }}</p>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-lg-2">
                <a href="{{ route('CustomerQueries.index') }}">
                    <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                        <div class="card-body text-center">
                            <i class="i-Timer1" style="height: 30px"></i>
                            <div class="content">
                                <p class="text-muted mt-2 mb-0">DiscountOffered</p>
                                <p class="text-primary text-15 line-height-1 mb-2"></p>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-lg-3">
                <a href="{{ route('allcat') }}">
                    <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                        <div class="card-body text-center">
                            <i class="i-Timer1" style="height: 30px"></i>
                            <div class="content">
                                <p class="text-muted mt-2 mb-0">TotalCategories</p>
                                <p class="text-primary text-15 line-height-1 mb-2">{{ $cat }}</p>
                            </div>
                        </div>
                    </div>
                </a>
            </div>


            <div class="col-lg-3">
                <a href="{{ route('sub-category.index') }}">
                    <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                        <div class="card-body text-center">
                            <i class="i-Timer1" style="height: 30px"></i>
                            <div class="content">
                                <p class="text-muted mt-2 mb-0">TotalSub-Categories</p>
                                <p class="text-primary text-15 line-height-1 mb-2">{{ $s }}</p>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

        </div>
    @endif
    {{-- <div class="col-lg-3">
            <a href="{{ route('confirmedorders') }}">
                <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                    <div class="card-body text-center">
                        <i class="i-Check" style="height: 30px"></i>
                        <div class="content">
                            <p class="text-muted mt-2 mb-0">Confirmed</p>
                            <p class="text-primary text-15 line-height-1 mb-2">{{ $confirmed }}</p>
                        </div>
                    </div>
                </div>
            </a>
        </div> --}}
    {{-- <div class="col-lg-3">
            <a href="{{ route('packagingorders') }}">
                <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                    <div class="card-body text-center">
                        <i class="i-Check" style="height: 30px"></i>
                        <div class="content">
                            <p class="text-muted mt-2 mb-0">Packaging</p>
                            <p class="text-primary text-15 line-height-1 mb-2">{{ $packaging }}</p>
                        </div>
                    </div>
                </div>
            </a>
        </div> --}}

    {{-- <div class="col-lg-3">
            <a href="{{ route('ftod') }}">
                <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                    <div class="card-body text-center">
                        <i class="i-Warning-Window" style="height: 30px"></i>
                        <div class="content">
                            <p class="text-muted mt-2 mb-0">Failed</p>
                            <p class="text-primary text-15 line-height-1 mb-2">{{ $ftod }}</p>
                        </div>
                    </div>
                </div>
            </a>
        </div> --}}




    <div class="row">
        <div class="col-lg-2">
            <a href="{{ route('allrefunds') }}">
                <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                    <div class="card-body text-center">
                        <i class="i-Timer1" style="height: 30px"></i>
                        <div class="content">
                            <p class="text-muted mt-2 mb-0">TotalRefund</p>
                            <p class="text-primary text-15 line-height-1 mb-2">{{ $refund }}</p>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-lg-2">
            <a href="{{ route('productreviews') }}">
                <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                    <div class="card-body text-center">
                        <i class="i-Timer1" style="height: 30px"></i>
                        <div class="content">
                            <p class="text-muted mt-2 mb-0">TotalReviews</p>
                            <p class="text-primary text-15 line-height-1 mb-2"></p>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-lg-3">
            <a href="{{ route('products.index') }}">
                <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                    <div class="card-body text-center">
                        <i class="i-Add-Cart"></i>
                        <div class="content">
                            <p class="text-muted mt-2 mb-0">TotalProductOutofStocks</p>
                            <p class="text-primary text-24 line-height-1 mb-2">{{ $products }}</p>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        @if (Auth::User()->role == 'Admin')
            <div class="col-lg-3">
                <a href="{{ route('allorders') }}">
                    <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                        <div class="card-body text-center">
                            <i class="i-Add-Cart"></i>
                            <div class="content">
                                <p class="text-muted mt-2 mb-0">TotalUsedProducts</p>
                                <p class="text-primary text-24 line-height-1 mb-2">{{ $currenOrders }}</p>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-2">
                <a href="{{ route('products.index') }}">
                    <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                        <div class="card-body text-center">
                            <i class="i-Add-Cart"></i>
                            <div class="content">
                                <p class="text-muted mt-2 mb-0">TotalAvailableStocks</p>
                                <p class="text-primary text-24 line-height-1 mb-2">{{ $products }}</p>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

    </div>
    @endif



    <div class="row">
        <div class="col-lg-8 col-md-12">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="card-title">Top Product by Category</div>
                    {{-- <div id="echartBar" style="height: 300px;"></div> --}}
                    <div id="productChart" style="height: 300px;"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-sm-12">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="card-title">Products By Vendor</div>
                    <div id="echartPie" style="height: 300px;"></div>
                </div>
            </div>
        </div>

        <div class=" col-lg-4 col-sm-12" style="width:420px;">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="card-title">Total Commission Earned</div>
                    <div id="simplePie"></div>
                </div>
            </div>
        </div>

        {{-- <div class="col-lg-8 col-md-12">
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="card-title">Single Bar chart</div>
                            <canvas id="BarChart"></canvas>
                        </div>
                    </div>
                </div> --}}


        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="card-title">Total Order by Date</div>
                    <div id="zoomBar1" style="height: 365px;"></div>
                </div>
            </div>
        </div>

        <div class="card mb-2 col-md-2" style="width: revert; overflow-y:auto;height:448px;">
            <div class="card-body">
                <div class="card-title">Total Out Of Stock</div>
                {{-- {{ $outofstock}} --}}
                @if ($outofstock)
                    @foreach ($outofstock ?? [] as $item)
                        <div class="d-flex flex-column flex-sm-row align-items-center mb-3">
                            <img class="avatar-lg mb-3 mb-sm-0 rounded me-sm-3" loading="lazy" loading="lazy"
                                src="{{ asset($item->product->url ?? null) }}" alt="">
                            <div class="flex-grow-1">
                                <h6 class=""><span {{-- class="text-black">{{ Str::limit($item->product->name, 20 ?? null) }}</span> --}} </h6>
                                        {{-- <p class="m-0 text-small text-muted">{{ Str::limit($item->product->model_no, 20) }}</p> --}}
                                        <p class="text-small text-danger m-0">
                                            {{ $item->product->new_sale_price ?? null }} </p>
                            </div>
                        </div>
                    @endforeach
                @endif

            </div>
        </div>




    </div>



    <div class="row">


        <div class="col-lg-6 col-md-12">

            <div class="row">
                <div class="">
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="card-title"> Total Sale</div>
                            <div id="zoomableLine-chart"></div>
                        </div>
                    </div>
                </div>

                {{-- <div class="col-lg-6 col-md-12">
                            <div class="card card-chart-bottom o-hidden mb-4">
                                <div class="card-body">
                                    <div class="text-muted">Last Week Sales</div>
                                    <p class="mb-4 text-warning text-24">$10250</p>
                                </div>
                                <div id="echart2" style="height: 260px;"></div>
                            </div>
                        </div> --}}
            </div>



        </div>
        <div class="col-lg-6 col-md-12">

            <div class="row">
                <div class="">
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="card-title"> Top 10 Supplier by Sales</div>
                            <div id="basicBar-chart"></div>
                        </div>
                    </div>
                </div>

                {{-- <div class="col-lg-6 col-md-12">
                            <div class="card card-chart-bottom o-hidden mb-4">
                                <div class="card-body">
                                    <div class="text-muted">Last Week Sales</div>
                                    <p class="mb-4 text-warning text-24">$10250</p>
                                </div>
                                <div id="echart2" style="height: 260px;"></div>
                            </div>
                        </div> --}}
            </div>



        </div>



        <div class="row">
            <div class="col-md-6">
                <div class="card o-hidden mb-4">
                    <div class="card-header d-flex align-items-center border-0">
                        <h3 class="w-50 float-start card-title m-0">Top 20 Buyers</h3>
                        <div class="dropdown dropleft text-end w-50 float-end">
                            <button class="btn bg-gray-100" type="button" id="dropdownMenuButton1"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="nav-icon i-Gear-2"></i>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                <a class="dropdown-item" href="{{ url('/users/add') }}">Add new user</a>
                                <a class="dropdown-item" href="{{ url('/users/userlist') }}">View All users</a>
                            </div>
                        </div>
                    </div>

                    <div class="">
                        <div class="table-responsive" style="overflow-y:auto;height:445px;">
                            <table id="user_table" class="table  text-center">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Phone</th>
                                        {{-- <th scope="col">Status</th> --}}

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($new_users as $key => $user)
                                        <tr>
                                            <th scope="row">{{ $key + 1 }}</th>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->phone1 }}</td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>


            </div>

            <div class="col-lg-3 col-md-6">

                <div class="card mb-2">
                    <div class="card-body" style="overflow-y:auto;height:500px;">
                        <div class="card-title">Top Selling Products</div>
                        @foreach ($top_products as $item)
                            <div class="d-flex flex-column flex-sm-row align-items-center mb-3" style="">
                                <img class="avatar-lg mb-3 mb-sm-0 rounded me-sm-3" loading="lazy" src="{{ asset($item->url) }}"
                                    alt="">
                                <div class="flex-grow-1">
                                    <h5 class=""><a href="" class="text-black">{{ $item->name }}</a></h5>
                                    <p class="m-0 text-small text-muted">{{ $item->slug }}</p>
                                    <p class="text-small text-danger m-0"> {{ $item->new_sale_price }} <del
                                            class="text-muted">{{ $item->new_price }}</del></p>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>

                {{-- <div class="card mb-4">
                            <div class="card-body p-0">
                                <div class="card-title border-bottom d-flex align-items-center m-0 p-3">
                                    <span>User activity</span>
                                    <span class="flex-grow-1"></span>
                                    <span class="badge badge-pill text-bg-warning">Updated daily</span>
                                </div>
                                <div class="d-flex border-bottom justify-content-between p-3">
                                    <div class="flex-grow-1">
                                        <span class="text-small text-muted">Pages / Visit</span>
                                        <h5 class="m-0">2065</h5>
                                    </div>
                                    <div class="flex-grow-1">
                                        <span class="text-small text-muted">New user</span>
                                        <h5 class="m-0">465</h5>
                                    </div>
                                    <div class="flex-grow-1">
                                        <span class="text-small text-muted">Last week</span>
                                        <h5 class="m-0">23456</h5>
                                    </div>
                                </div>
                                <div class="d-flex border-bottom justify-content-between p-3">
                                    <div class="flex-grow-1">
                                        <span class="text-small text-muted">Pages / Visit</span>
                                        <h5 class="m-0">1829</h5>
                                    </div>
                                    <div class="flex-grow-1">
                                        <span class="text-small text-muted">New user</span>
                                        <h5 class="m-0">735</h5>
                                    </div>
                                    <div class="flex-grow-1">
                                        <span class="text-small text-muted">Last week</span>
                                        <h5 class="m-0">92565</h5>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between p-3">
                                    <div class="flex-grow-1">
                                        <span class="text-small text-muted">Pages / Visit</span>
                                        <h5 class="m-0">3165</h5>
                                    </div>
                                    <div class="flex-grow-1">
                                        <span class="text-small text-muted">New user</span>
                                        <h5 class="m-0">165</h5>
                                    </div>
                                    <div class="flex-grow-1">
                                        <span class="text-small text-muted">Last week</span>
                                        <h5 class="m-0">32165</h5>
                                    </div>
                                </div>
    
                            </div>
                        </div> --}}

            </div>
            <div class="col-lg-3 col-md-6">

                <div class="card mb-2">
                    <div class="card-body" style="overflow-y:auto;height:500px;">
                        <div class="card-title">Latest Coupons</div>
                        @foreach ($coupons as $coupon)
                            <div class="d-flex flex-column flex-sm-row align-items-center mb-3">
                                <div class="flex-grow-1">
                                    <h4 class=""><a href=""
                                            class="text-black">{{ $coupon->coupon_title }}</a></h4>
                                    <p class="m-0 text-small text-muted">{{ $coupon->store }}</p>
                                    <p class="text-small text-info">Coupon Status: <span
                                            class="text-small text-danger m-0">{{ $coupon->status }}</span> <br> <span
                                            class="text-small text-black m-0">Minimum Purchase : </span> <span
                                            class="text-info">{{ $coupon->minimum_purchase }} </span> </p>
                                </div>
                                <div>
                                    <button class="btn btn-outline-danger btn-rounded btn-sm">{{ $coupon->start_date }} :
                                        {{ $coupon->end_date }}</button>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>


            </div>

        </div>



        {{-- <div class="col-md-12">
                    <div class="card mb-4">
                        <div class="card-body p-0">
                            <h5 class="card-title m-0 p-3">Last 20 Day Leads</h5>
                            <div id="echart3" style="height: 360px;"></div>
                        </div>
                    </div>
                </div> --}}

    </div>
@endsection


@section('page-js')
    


<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
<script src="{{ asset('assets/js/vendor/echarts.min.js') }}"></script>
<script src="{{ asset('assets/js/es5/echart.options.min.js') }}"></script>
<script src="{{ asset('assets/js/es5/dashboard.v1.script.js') }}"></script>
<script src="{{ asset('assets/js/vendor/apexcharts.min.js') }}"></script>
<script src="{{ asset('assets/js/vendor/apexcharts.dataseries.js') }}"></script>
<script src="{{ asset('assets/js/es5/apexChart.script.min.js') }}"></script>
<script src="{{ asset('assets/js/es5/apexBarChart.script.min.js') }}"></script>
<script src="{{ asset('assets/js/es5/apexPieDonutChart.script.min.js') }}"></script>
<script src="{{ asset('assets/js/es5/chartjs.script.min.js') }}"></script>
<script src="{{ asset('assets/js/es5/apexColumnChart.script.min.js') }}"></script>
<script src="{{ asset('assets/js/es5/echarts.script.min.js') }}"></script>


<script>
    // Initialize ECharts instance
    var productChart = echarts.init(document.getElementById('productChart'));

    // Fetch data from the Laravel backend
    $.get('/get-product-chart-data', function(data) {
        // Define chart options
        var options = {
            legend: {
                borderRadius: 0,
                orient: 'horizontal',
                x: 'right',
                data: ['']
            },
            grid: {
                left: '8px',
                right: '8px',
                bottom: '0',
                containLabel: true
            },
            tooltip: {
                show: true,
                backgroundColor: 'rgba(0, 0, 0, .8)'
            },
            xAxis: [{
                type: 'category',
                data: data.categories,
                axisLabel: {
                    // position: 'top',
                    show: false,
                }
            }],
            yAxis: [{
                type: 'value',
                name: 'Product Count'
            }],
            grid: {
                left: '10%',
                right: '10%',
                bottom: '10%',
                containLabel: true
            },
            series: [{
                name: '',
                type: 'bar',
                barWidth: '70%', // Adjust the bar width as needed
                label: {
                    show: true, // Display the value on top of each bar
                    position: 'inside'
                },
                data: data.productCounts,
                // Change the color to blue
                itemStyle: {
                    color: '#0071BF'
                }
            }]
        };

        // Set the chart options
        productChart.setOption(options);
    });
</script>

<script>
    var y = document.getElementById("zoomBar1");
    if (y) {


        var b = echarts.init(y);
        b.setOption({
                tooltip: {
                    trigger: "axis",
                    axisPointer: {
                        type: "shadow",
                        shadowStyle: {
                            opacity: 0
                        }
                    },
                },
                grid: {
                    top: "8%",
                    left: "3%",
                    right: "4%",
                    bottom: "3%",
                    containLabel: !0,
                },
                xAxis: {

                    data: [
                        "01",
                        "02",
                        "03",
                        "04",
                        "05",
                        "06",
                        "07",
                        "08",
                        "09",
                        "10",
                        "11",
                        "12",
                        "13",
                        "14",
                        "15",
                        "16",
                        "17",
                        "18",
                        "19",
                        "20",
                        "21",
                        "22",
                        "23",
                        "24",
                        "25",
                        "26",
                        "27",
                        "28",
                        "29",
                        "30",
                    ],
                    axisLabel: {
                        inside: !0,
                        textStyle: {
                            color: "#fff"
                        }
                    },
                    axisTick: {
                        show: !1
                    },
                    axisLine: {
                        show: !1
                    },
                    z: 10,
                },
                yAxis: {
                    axisLine: {
                        show: !1
                    },
                    axisTick: {
                        show: !1
                    },
                    axisLabel: {
                        textStyle: {
                            color: "#999"
                        }
                    },
                    splitLine: {
                        show: !1
                    },
                },
                dataZoom: [{
                    type: "inside"
                }],
                series: [{
                        name: "Total Ordes",
                        type: "bar",
                        itemStyle: {
                            normal: {
                                color: "rgba(0,0,0,0.05)"
                            }
                        },
                        barGap: "-100%",
                        barCategoryGap: "40%",
                        data: [
                            500, 500, 500, 500, 500, 500, 500, 500, 500, 500, 500,
                            500, 500, 500, 500, 500, 500, 500, 500, 500, 500, 500,
                            500, 500, 500, 500, 500, 500, 500, 500,
                        ],
                        animation: !1,
                    },
                    {
                        name: "Completed Order",
                        type: "bar",
                        itemStyle: {
                            normal: {
                                color: new echarts.graphic.LinearGradient(
                                    0,
                                    0,
                                    0,
                                    1,
                                    [{
                                            offset: 0,
                                            color: "#83bff6"
                                        },
                                        {
                                            offset: 0.5,
                                            color: "#188df0"
                                        },
                                        {
                                            offset: 1,
                                            color: "#188df0"
                                        },
                                    ]
                                ),
                            },
                            emphasis: {
                                color: new echarts.graphic.LinearGradient(
                                    0,
                                    0,
                                    0,
                                    1,
                                    [{
                                            offset: 0,
                                            color: "#2378f7"
                                        },
                                        {
                                            offset: 0.7,
                                            color: "#2378f7"
                                        },
                                        {
                                            offset: 1,
                                            color: "#83bff6"
                                        },
                                    ]
                                ),
                            },
                        },
                        data: [
                            220, 182, 191, 234, 290, 330, 310, 123, 442, 321, 90,
                            149, 210, 122, 133, 334, 198, 123, 125, 220, 220, 182,
                            191, 234, 290, 330, 310, 123, 442, 212,
                        ],
                    },
                ],
            }),
            $(window).on("resize", function() {
                setTimeout(function() {
                    b.resize();
                }, 500);
            });
    }
</script>
@endsection
