@extends('layouts.master')

@section('content')
    <div class="page-body">

        <!-- Container-fluid starts-->
        <div class="container-fluid">
            <div class="page-header">
                <div class="row">
                    <div class="col">
                        <div class="page-header-left">
                            <h3>Advertisement Management's
                                {{-- <small></small> --}}
                            </h3>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <ol class="breadcrumb pull-right">
                            <li class="breadcrumb-item"><a href="/"><i data-feather="home"></i></a></li>
                            <li class="breadcrumb-item"> Advertisements</li>
                            <li class="breadcrumb-item active">Advertisement Management</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- Container-fluid Ends-->



        <!-- Container-fluid starts-->
        <div class="container-fluid">
            <div class="row products-admin ratio_asos">
                @foreach ($data as $key => $item)
                    <div class="col-xl-3 col-sm-6">
                        <div class="card product">
                            <div class="card-body">
                                <div class="product-box p-0">
                                    <div class="product-imgbox">
                                        <a
                                            href="{{ route('advertisementSellers.show', ['advertisementSeller' => $item->id]) }}">
                                            <div class="product-front">
                                                <img src="/{{ $item->image }}" class="img-fluid " alt="product">
                                            </div>
                                            <div class="product-back">
                                                <img src="/{{ $item->image }}" class="img-fluid " alt="product">
                                            </div>
                                        </a>
                                        <div class="product-icon icon-inline">



                                        </div>
                                    </div>
                                    <div class="product-detail detail-inline p-0">
                                        <div class="detail-title">
                                            <div class="detail-left">
                                                <div class="rating-star">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                </div>
                                                <a href="">
                                                    <h6 class="price-title">
                                                        {{ $item->name }}
                                                    </h6>
                                                </a>

                                            </div>
                                            <div class="detail-right">
                                                <div class="check-price">
                                                    $ {{ $item->old_price }}
                                                </div>
                                                <div class="price">
                                                    <div class="price">
                                                        $ {{ $item->sale_price }}
                                                    </div>
                                                </div>
                                                @if ($item->quantity > 0)
                                                    <h6 style="color: green">Available</h6>
                                                @else
                                                    <h6 style="color: red">Not Available</h6>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
        <!-- Container-fluid Ends-->
    </div>
@endsection
