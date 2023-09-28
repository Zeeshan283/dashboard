@extends('layouts.master')

@section('page-css')

    <link rel="stylesheet" href="{{asset('assets/styles/vendor/apexcharts.css')}}">
    
@endsection

@section('main-content')    
           <div class="breadcrumb"> 
                <h1><a href="{{ route('admin') }}">Admin Dashboard</a></h1>
            </div>
            
            <div class="separator-breadcrumb border-top"></div>

            <div class="row">
                <!-- ICON BG -->
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                        <div class="card-body text-center"> 
                            <i class="i-Shopping-Bag"></i>
                            <div class="content">
                                <p class="text-muted mt-2 mb-0">Total Sales</p>
                                <p class="text-primary text-24 line-height-1 mb-2">{{ $totalOrders }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-sm-6">
                    <a href="{{ route('products.index')}}">
                    <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                        <div class="card-body text-center">
                            <i class="i-Add-Cart"></i>
                            <div class="content">
                                <p class="text-muted mt-2 mb-0">Products</p>
                                <p class="text-primary text-24 line-height-1 mb-2">{{ $products}}</p>
                            </div>
                        </div>
                    </div></a>
                </div>

                <div class="col-lg-4 col-md-6 col-sm-6">
                    <a href="{{ route('allorders')}}">
                    <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                        <div class="card-body text-center">
                            <i class="i-Shopping-Cart"></i>
                            <div class="content">
                                <p class="text-muted mt-2 mb-0">Orders</p>
                                <p class="text-primary text-24 line-height-1 mb-2">{{ $currenOrders}}</p>
                            </div>
                        </div>
                    </div></a>
                </div>


            </div>

            {{-- medium icons and values  --}}
            <div class="row" >
                <!-- ICON BG -->
                @if(Auth::User()->role == 'Admin')
                <div class="col-lg-3 col-md-6 col-sm-6" >
                    <a href="{{ route('vendor.index')}}">
                    <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4" >
                        <div class="card-body text-center">
                            <i class="i-Add-User" style="height: 30px"></i>
                            <div class="content">
                                <p class="text-muted mt-2 mb-0">TotalVendors</p>
                                <p class="text-primary text-15 line-height-1 mb-2">{{ $vendorlist }}</p>
                            </div>
                        </div>
                    </div></a>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-6" >
                    <a href="{{ route('customerlist')}}">
                    <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4" >
                        <div class="card-body text-center">
                            <i class="i-Add-User" style="height: 30px"></i>
                            <div class="content">
                                <p class="text-muted mt-2 mb-0">TotalCustomers</p>
                                <p class="text-primary text-15 line-height-1 mb-2">{{ $customer }}</p>
                            </div>
                        </div>
                    </div></a>
                </div>

                @endif
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <a href="{{ route('CustomerQueries.index')}}">
                    <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                        <div class="card-body text-center">
                            <i class="i-Timer1" style="height: 30px"></i>
                            <div class="content" >
                                <p class="text-muted mt-2 mb-0">CustomerQueries</p>
                                <p class="text-primary text-15 line-height-1 mb-2">{{ $customerQueries }}</p>
                            </div>
                        </div>
                    </div></a>
                </div>
                
                <div class="col-lg-3 col-md-6 col-sm-6" >
                    <a href="{{ route('pendingorders')}}">
                    <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4" >
                        <div class="card-body text-center">
                            <i class="i-Clock" style="height: 30px"></i>
                            <div class="content">
                                <p class="text-muted mt-2 mb-0">PendingOrders</p>
                                <p class="text-primary text-15 line-height-1 mb-2">{{ $pending }}</p>
                            </div>
                        </div>
                    </div></a>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-6">
                    <a href="{{ route('confirmedorders')}}">
                    <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                        <div class="card-body text-center">
                            <i class="i-Check" style="height: 30px"></i>
                            <div class="content">
                                <p class="text-muted mt-2 mb-0">Confirmed</p>
                                <p class="text-primary text-15 line-height-1 mb-2">{{ $confirmed}}</p>
                            </div>
                        </div>
                    </div></a>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <a href="{{ route('packagingorders')}}">
                    <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                        <div class="card-body text-center">
                            <i class="i-Check" style="height: 30px"></i>
                            <div class="content">
                                <p class="text-muted mt-2 mb-0">Packaging</p>
                                <p class="text-primary text-15 line-height-1 mb-2">{{$packaging}}</p>
                            </div>
                        </div>
                    </div></a>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-6">
                    <a href="{{ route('ftod')}}">
                    <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                        <div class="card-body text-center">
                            <i class="i-Warning-Window" style="height: 30px"></i>
                            <div class="content" >
                                <p class="text-muted mt-2 mb-0">Failed</p>
                                <p class="text-primary text-15 line-height-1 mb-2">{{ $ftod }}</p>
                            </div>
                        </div>
                    </div></a>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <a href="{{ route('delivered')}}">
                    <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                        <div class="card-body text-center">
                            <i class="i-Check" style="height: 30px"></i>
                            <div class="content" >
                                <p class="text-muted mt-2 mb-0">Delivered</p>
                                <p class="text-primary text-15 line-height-1 mb-2">{{ $delivered }}</p>
                            </div>
                        </div>
                    </div></a>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <a href="{{ route('canceled')}}">
                    <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                        <div class="card-body text-center">
                            <i class="i-Timer1" style="height: 30px"></i>
                            <div class="content" >
                                <p class="text-muted mt-2 mb-0">Cancled</p>
                                <p class="text-primary text-15 line-height-1 mb-2">{{ $canceled }}</p>
                            </div>
                        </div>
                    </div></a>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <a href="{{ route('returned')}}">
                    <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                        <div class="card-body text-center">
                            <i class="i-Timer1" style="height: 30px"></i>
                            <div class="content" >
                                <p class="text-muted mt-2 mb-0">Returned</p>
                                <p class="text-primary text-15 line-height-1 mb-2">{{ $returned }}</p>
                            </div>
                        </div>
                    </div></a>
                </div>
                

        
            </div>

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
                                    <div class="card-title"> Sales by Vendor</div>
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
                                <h3 class="w-50 float-start card-title m-0">New Users</h3>
                                <div class="dropdown dropleft text-end w-50 float-end">
                                    <button class="btn bg-gray-100" type="button" id="dropdownMenuButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="nav-icon i-Gear-2"></i>
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                        <a class="dropdown-item" href="#">Add new user</a>
                                        <a class="dropdown-item" href="#">View All users</a>
                                        <a class="dropdown-item" href="#">Something else here</a>
                                    </div>
                                </div>
                            </div>

                            <div class="">
                                <div class="table-responsive">
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
                                                <th scope="row">{{$key + 1}}</th>
                                                <td>{{$user->name}}</td>
                                                <td>{{$user->email}}</td>
                                                <td>{{$user->phone1}}</td>
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
                            <div class="card-body">
                                <div class="card-title">Top  Products</div> 
                                @foreach ($top_products as $item)
                                <div class="d-flex flex-column flex-sm-row align-items-center mb-3">
                                    <img class="avatar-lg mb-3 mb-sm-0 rounded me-sm-3" src="{{ asset($item->url)}}" alt="">
                                    <div class="flex-grow-1">
                                        <h5 class=""><a href="" class="text-black">{{ $item->name}}</a></h5>
                                        <p class="m-0 text-small text-muted">{{$item->slug}}</p>
                                        <p class="text-small text-danger m-0"> {{$item->new_sale_price}} <del class="text-muted">{{$item->new_price}}</del></p>
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
                            <div class="card-body">
                                <div class="card-title">Latest Coupons</div> 
                                @foreach ($coupons as $coupon)
                                <div class="d-flex flex-column flex-sm-row align-items-center mb-3">
                                    <div class="flex-grow-1">
                                        <h4 class=""><a href="" class="text-black">{{ $coupon->coupon_title}}</a></h4>
                                        <p class="m-0 text-small text-muted">{{$coupon->store}}</p>
                                        <p class="text-small text-info">Coupon Status: <span class="text-small text-danger m-0">{{$coupon->status}}</span> <br> <span class="text-small text-black m-0">Minimum Purchase : </span> <span class="text-info">{{$coupon->minimum_purchase}} </span> </p>
                                    </div>
                                    <div>
                                        <button class="btn btn-outline-danger btn-rounded btn-sm">{{ $coupon->start_date }} : {{$coupon->end_date}}</button>
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
    <script src="{{asset('assets/js/vendor/echarts.min.js')}}"></script>
    <script src="{{asset('assets/js/es5/echart.options.min.js')}}"></script>
    <script src="{{asset('assets/js/es5/dashboard.v1.script.js')}}"></script>
    <script src="{{asset('assets/js/vendor/apexcharts.min.js')}}"></script>
    <script src="{{asset('assets/js/vendor/apexcharts.dataseries.js')}}"></script>
    <script src="{{asset('assets/js/es5/apexChart.script.min.js')}}"></script>
    <script src="{{asset('assets/js/es5/apexBarChart.script.min.js')}}"></script>



     <script>
        // Initialize ECharts instance
        var productChart = echarts.init(document.getElementById('productChart'));
    
        // Fetch data from the Laravel backend
        $.get('/get-product-chart-data', function (data) {
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
                        position: 'top'
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

    
    
@endsection
