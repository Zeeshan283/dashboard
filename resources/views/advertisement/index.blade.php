@extends('layouts.master')

@section('main-content')
    <div class="breadcrumb">
        <h1>Advertisement</h1>
        <ul>
            <li><a href="">.</a></li>
            <li>.</li>
        </ul>
    </div>
    <div class="separator-breadcrumb border-top"></div>


    <section class="product-cart">
        <div class="row list-grid">
            @foreach ($data as $key => $item)
                <div class="list-item col-md-3">
                    <a href="{{ route('advertisements.edit', ['advertisement' => $item->id]) }}" title="edit">
                        <div class="card o-hidden mb-4 d-flex flex-column">
                            <div class="list-thumb d-flex">
                                <img alt="" src="/{{ $item->image }}">
                            </div>
                            <div class="flex-grow-1 d-bock">
                                <div
                                    class="card-body align-self-center d-flex flex-column justify-content-between align-items-lg-center">
                                    <a class="w-40 w-sm-100" href="">
                                        <div class="item-title">
                                            {{ $item->name }}
                                        </div>
                                    </a>
                                    <p class="m-0 text-muted text-small w-15 w-sm-100">

                                    </p>
                                    @php
                                        $percentage = (($item->old_price - $item->sale_price) / $item->old_price) * 100;

                                    @endphp
                                    <p class="m-0 text-muted text-small w-15 w-sm-100">
                                        $ {{ $item->sale_price }} <del class="text-secondary">$
                                            {{ $item->old_price }}</del>
                                    </p>
                                    <p class="m-0 text-muted text-small w-15 w-sm-100 d-none d-lg-block item-badges">
                                        <span class="badge badge-info"
                                            style="background: green;">{{ number_format($percentage, 2) }}% off</span>
                                    </p>
                                    @if ($item->quantity > 0)
                                        <h6 style="color: green">Available</h6>
                                    @else
                                        <h6 style="color: red">Not Available</h6>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach

            {{-- <div class="col-md-12 mt-3  ">
                <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        <li class="page-item">
                            <a class="page-link" href="#">Previous</a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="#">1</a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="#">2</a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="#">3</a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="#">Next</a>
                        </li>
                    </ul>
                </nav>
            </div> --}}
        </div>
    </section>
@endsection
