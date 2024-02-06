@extends('layouts.master')

@section('main-content')
<div class="breadcrumb">
    <h1>All Products</h1>
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
            <a href="https://industrymall.net/product-details/{{ $item->id}}" target="__BLANK" title="View">
                <div class="card o-hidden mb-4 d-flex flex-column">
                    <div class="list-thumb d-flex">
                        <img alt="N/A" loading="lazy" src="{{ $item->url }}">
                    </div>
                    <div class="flex-grow-1 d-bock">
                        <div
                            class="card-body align-self-center d-flex flex-column justify-content-between align-items-lg-center">
                            <a class="w-40 w-sm-100" href="{{ Route('products.edit',['product' => $item->id]) }}"
                                target="__BLANK" title="Edit">
                                <div class="item-title">
                                    {{ $item->name }}
                                </div>
                            </a>
                            <p class="m-0 text-muted text-small w-15 w-sm-100">

                            </p>
                            @php
                            $percentage = (($item->new_price - $item->new_sale_price) / $item->new_price) * 100;

                            @endphp
                            <p class="m-0 text-muted text-small w-15 w-sm-100">
                                $ {{ $item->new_sale_price }}
                                <del class="text-secondary">$
                                    {{$item->new_price }}
                                </del>
                            </p>
                            <p class="m-0 text-muted text-small w-15 w-sm-100 d-none d-lg-block item-badges">
                                <span class="badge badge-info"
                                    style="background: green;">{{ number_format($percentage, 2) }}% off</span>
                            </p>
                            <h6 style="color: green">Available</h6>
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
    <div class="col-md-12 mt-3">
        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center">

                <!-- Previous Page Link -->
                @if ($data->onFirstPage())
                <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                    <span class="page-link" aria-hidden="true">&lsaquo;</span>
                </li>
                @else
                <li class="page-item">
                    <a class="page-link" href="{{ $data->previousPageUrl() }}" rel="prev"
                        aria-label="@lang('pagination.previous')">&lsaquo;</a>
                </li>
                @endif

                <!-- Pagination Elements -->
                @php
                $start = max(1, $data->currentPage() - 2);
                $end = min($data->lastPage(), $data->currentPage() + 2);
                @endphp

                @if ($start > 1)
                <li class="page-item"><a class="page-link" href="{{ $data->url(1) }}">1</a></li>
                @if ($start > 2)
                <li class="page-item disabled" aria-disabled="true"><span class="page-link">...</span></li>
                @endif
                @endif

                @for ($i = $start; $i <= $end; $i++) @if ($i==$data->currentPage())
                    <li class="page-item active" aria-current="page"><span class="page-link">{{ $i }}</span></li>
                    @else
                    <li class="page-item"><a class="page-link" href="{{ $data->url($i) }}">{{ $i }}</a></li>
                    @endif
                    @endfor

                    @if ($end < $data->lastPage())
                        @if ($end < $data->lastPage() - 1)
                            <li class="page-item disabled" aria-disabled="true"><span class="page-link">...</span></li>
                            @endif
                            <li class="page-item"><a class="page-link"
                                    href="{{ $data->url($data->lastPage()) }}">{{ $data->lastPage() }}</a></li>
                            @endif

                            <!-- Next Page Link -->
                            @if ($data->hasMorePages())
                            <li class="page-item">
                                <a class="page-link" href="{{ $data->nextPageUrl() }}" rel="next"
                                    aria-label="@lang('pagination.next')">&rsaquo;</a>
                            </li>
                            @else
                            <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                                <span class="page-link" aria-hidden="true">&rsaquo;</span>
                            </li>
                            @endif

            </ul>
        </nav>
    </div>



</section>
@endsection