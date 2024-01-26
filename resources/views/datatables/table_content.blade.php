<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<style>
.star-rating {
    font-size: 0;
}

.star {
    display: inline-block;
    width: 20px;
    /* Adjust the width as needed */
    height: 20px;
    /* Adjust the height as needed */
    background: gray;
    /* Default color for uncolored stars */
    clip-path: polygon(50% 0%,
            61.8% 35.3%,
            98.2% 35.3%,
            68.2% 57.3%,
            79.1% 91.2%,
            50% 70.9%,
            20.9% 91.2%,
            31.8% 57.3%,
            1.8% 35.3%,
            38.2% 35.3%);
}

.star-filled {
    background: yellow;
    /* Color for filled (rated) stars */
}

.star-partial {
    background: gray;
    /* Color for uncolored stars */
}
</style>



@if (Route::currentRouteName() == 'allorders')
<thead>
    <th>Order #</th>
    <th>Order Date</th>
    <th>Customer Name</th>
    <th>Amount</th>
    <th>Location</th>
    {{-- <th>Status</th> --}}
    <th>Action</th>
</thead>
<tbody>
    @foreach ($data as $value => $orders)
    <tr>


        <td>#{{ $orders->id }}</td>
        <td>{{ $orders->created_at ?? null }}</td>
        <td>{{ $orders->first_name  ?? null }} {{ $orders->last_name ?? null}}</td>
        <td>{{ $orders->total_price ?? null }}</td>

        <td>{{ $orders->shipping_address ?? null }},{{ $orders->shipping_city ?? null}},{{ $orders->shipping_state ?? null}}
            {{ $orders->shipping_zipcode ?? null}},{{ $orders->shipping_country ?? null}}</td>

        {{-- <form method="POST" action="{{ route('order.status', ['id' => $orders->id]) }}">

        @csrf

        @method('PATCH')

        <td>
            <select class="form-control" name="status" id="status{{ $orders->id }}">
                <option value="" selected disabled>{{ $orders->status }}</option>
                <option value="In Process">In Process</option>
                <option value="Packaging">Packaging</option>
                <option value="Confirmed">Confirmed</option>
                <option value="Out of delivery">Out of Delivery</option>
                <option value="Delivered">Delivered</option>
                <option value="Failed to Deliver">Failed to Deliver</option>
                <option value="Returned">Returned</option>
                <option value="Canceled">Canceled</option>
            </select>
        </td>

        <td class="d-flex 2">

            <input type="hidden" value="{{ $orders->id }}" name="order_id" hidden>

            <button type="submit" class="btn btn-outline-secondary ladda-button example-button m-1"
                data-style="expand-left"><span class="ladda-label">Update</span></button>


            </div>

        </td>

        </form> --}}

        <td>
            <a href="{{ url('get_order_details/' . $orders->id) }}" class="btn btn-outline-secondary"><i
                    class="nav-icon i-Eye "></i></a>
        </td>
    </tr>
    @endforeach
</tbody>
<tfoot>
    <tr>
        <th>Order #</th>
        <th>Order Date</th>
        <th>Customer Name</th>
        <th>Amount</th>
        <th>Location</th>
        {{-- <th>Status</th> --}}
        <th>Action</th>
    </tr>
</tfoot>

@elseif (Route::currentRouteName() == 'get_order_details')
<thead>
    {{-- <th>Sr No</th> --}}
    <th>Order Id#</th>
    <th>Sub Order Id #</th>
    <th>Vendor Name</th>
    <th>Customer Name</th>
    <th>Product Name</th>
    <th>Product Model</th>
    <th>Product Sku</th>
    <th>Product Price</th>
    <th>Order Date</th>
    {{-- <th>Shipping Date</th> --}}
    <th>Image</th>
    <th>Status</th>
    <th>Action</th>
</thead>
<tbody>
    @foreach ($GetOrderDetails as $value => $orders)
    <tr>

        {{-- <td>{{ $value + 1 }}</td> --}}

        <td>{{ $orders->order_id }}</td>
        <td>{{ $orders->id }}</td>
        <td>{{ $orders->vendor->name ?? null }}</td>
        <td>{{ $orders->order->first_name  ?? null }} {{ $orders->order->last_name ?? null}}</td>
        <td>{{ $orders->product->name ?? null }} </td>
        <td>{{ $orders->product->model_no ?? null }} </td>
        <td>{{ $orders->product->sku ?? null }} </td>
        <!-- <td>{{ $orders->product->new_sale_price ?? null }} </td> -->
        <td>{{ $orders->p_price ?? null }} </td>
        {{-- <td>{{ $orders->first_name }}</td> --}}

        {{-- <td>{{ $orders->last_name }}</td> --}}

        <td>{{ $orders->created_at }}</td>
        <td>
            {{-- @if ($orders->product->url) --}}
            <img src="{{ $orders->product->url ?? null }}  " width="50" height="50" alt="Placeholder Image" loading="lazy">
            {{-- @else --}}
        </td>
        {{-- <td>{{ $orders->shipping }}</td> --}}
        {{-- <td>
            @if ($orders->product)
            @if ($orders->product->url)
            <img src="{{ $product->product_image->url }}" loading="lazy" width="50" height="50" alt="Placeholder Image" - Order ID:
        {{ $orders->id }}">
        <p>Order ID: {{ $orders->id }}</p>
        @else
        @if ($orders->product->product_image)
        <img src="{{ $product->product_image->url }}" loading="lazy" width="50" height="50" alt="Placeholder Image" - Order ID:
            {{ $orders->id }}">
        <p>Order ID: {{ $orders->id }}</p>
        @endif
        @endif
        @else
        <img src="{{ asset('path-to-your-placeholder-image.jpg') }}" loading="lazy" width="50" height="50" alt="Placeholder Image">
        <p>No image available</p>
        @endif
        </td> --}}

        <form method="POST" action="{{ route('order_details_status', ['id' => $orders->id]) }}">

            @csrf

            @method('PATCH')
            {{-- <input type="text" name="id" value="{{ $orders->order_id }}" /> --}}
            <td>
                <select class="form-control" name="status" id="status{{ $orders->id }}">
                    <option value="{{ $orders->status }}" selected disabled>{{ $orders->status }}</option>
                    <option value="In Process">In Process</option>
                    <option value="Packaging">Packaging</option>
                    <option value="Confirmed">Confirmed</option>
                    <option value="Out of delivery">Out of Delivery</option>
                    <option value="Delivered">Delivered</option>
                    <option value="Failed to Deliver">Failed to Deliver</option>
                    <option value="Returned">Returned</option>
                    <option value="Canceled">Canceled</option>


                </select>
            </td>

            <td>
                <div class="d-flex 2">
                    <button type="submit" class="btn btn-outline-secondary ladda-button example-button m-1"
                        data-style="expand-left"><span class="ladda-label">Update</span></button>
                    <a href="{{ url('get_order_detail_status/' . $orders->id) }}" class="btn btn-outline-secondary"><i
                            class="nav-icon i-Eye "></i></a>
                </div>
            </td>

        </form>

    </tr>
    @endforeach
</tbody>
<tfoot>
    <tr>
        {{-- <th>Sr No</th> --}}
        <th>Order Id#</th>
        <th>Sub Order Id #</th>
        <th>Vendor Name</th>
        <th>Customer Name</th>
        <th>Product Name</th>
    <th>Product Model</th>
        <th>Product Sku</th>
        <th>Product Price</th>
        <th>Order Date</th>
        {{-- <th>Shipping Date</th> --}}
        <th>Image</th>
        <th>Status</th>
        <th>Action</th>
    </tr>
</tfoot>


@elseif (Route::currentRouteName() == 'get_order_detail_status')
<thead>
    <th>Id #</th>
    <th>Order Detail Id #</th>
    <th>Status</th>
    <th>DateTime</th>
</thead>
<tbody>
    @foreach ($status as $value => $orders)
    <tr>

        <td>{{$value + 1 }}</td>
        <td>{{ $orders->order_id }}</td>
        <td>{{ $orders->status }} </td>
        <td>{{ $orders->datetime }} </td>
    </tr>
    @endforeach
</tbody>
<tfoot>
    <tr>
        <th>Id #</th>

        <th>Order Detail Id #</th>
        <th>Status</th>
        <th>DateTime</th>
    </tr>
</tfoot>

@elseif (Route::currentRouteName() == 'order_details')
<thead>
    {{-- <th>Sr No</th> --}}
    <th>Order Id#</th>
    <th>Sub Order Id #</th>
    <th>Vendor Name</th>
    <th>Customer Name</th>
    <th>Product Name</th>
    <th>Product Model</th>
    <th>Product Sku</th>
    <th>Product Price</th>
    <th>Order Date</th>
    {{-- <th>Shipping Date</th> --}}
    <th>Image</th>
    <th>Status</th>
    <th>Action</th>
</thead>
<tbody>
    @foreach ($data as $value => $orders)
    <tr>

        {{-- <td>{{ $value + 1 }}</td> --}}

        <td>{{ $orders->order_id }}</td>
        <td>{{ $orders->id }}</td>
        <td>{{ $orders->vendor->name ?? null }}</td>
        <td>{{ $orders->order->first_name  ?? null }} {{ $orders->order->last_name ?? null}}</td>

        <td>{{ $orders->product->name ?? null }} </td>
        <td>{{ $orders->product->model_no ?? null }} </td>

        <td>{{ $orders->product->sku ?? null }} </td>
        <!-- <td>{{ $orders->product->new_sale_price ?? null }} </td> -->
        <td>{{ $orders->p_price ?? null }} </td>
        {{-- <td>{{ $orders->first_name }}</td> --}}

        {{-- <td>{{ $orders->last_name }}</td> --}}

        <td>{{ $orders->created_at }}</td>
        <td>
            {{-- @if ($orders->product->url) --}}
            <img src="{{ $orders->product->url ?? null }}  " width="50" height="50" loading="lazy" alt="Placeholder Image">
            {{-- @else --}}
        </td>
        {{-- <td>{{ $orders->shipping }}</td> --}}
        {{-- <td>
            @if ($orders->product)
            @if ($orders->product->url)
            <img src="{{ $product->product_image->url }}" width="50" height="50" loading="lazy" alt="Placeholder Image" - Order ID:
        {{ $orders->id }}">
        <p>Order ID: {{ $orders->id }}</p>
        @else
        @if ($orders->product->product_image)
        <img src="{{ $product->product_image->url }}" width="50" height="50" loading="lazy" alt="Placeholder Image" - Order ID:
            {{ $orders->id }}">
        <p>Order ID: {{ $orders->id }}</p>
        @endif
        @endif
        @else
        <img src="{{ asset('path-to-your-placeholder-image.jpg') }}" loading="lazy" width="50" height="50" alt="Placeholder Image">
        <p>No image available</p>
        @endif
        </td> --}}

        <form method="POST" action="{{ route('order_details_status', ['id' => $orders->id]) }}">

            @csrf

            @method('PATCH')
            {{-- <input type="text" name="id" value="{{ $orders->order_id }}" /> --}}
            <td>
                <select class="form-control" name="status" id="status{{ $orders->id }}">
                    <option value="{{ $orders->status }}" selected disabled>{{ $orders->status }}</option>
                    <option value="In Process">In Process</option>
                    <option value="Packaging">Packaging</option>
                    <option value="Confirmed">Confirmed</option>
                    <option value="Out of delivery">Out of Delivery</option>
                    <option value="Delivered">Delivered</option>
                    <option value="Failed to Deliver">Failed to Deliver</option>
                    <option value="Returned">Returned</option>
                    <option value="Canceled">Canceled</option>


                </select>
            </td>

            <td class="d-flex 2">

                {{-- <input type="hidden" value="{{ $orders->id }}" name="order_id" hidden> --}}

                <button type="submit" class="btn btn-outline-secondary ladda-button example-button m-1"
                    data-style="expand-left"><span class="ladda-label">Update</span></button>

                <a href="{{ url('get_order_detail_status/' . $orders->id) }}" class="btn btn-outline-secondary"><i
                        class="nav-icon i-Eye "></i></a>
                </div>

            </td>

        </form>

    </tr>
    @endforeach
</tbody>
<tfoot>
    <tr>
        {{-- <th>Sr No</th> --}}
        <th>Order Id#</th>
        <th>Sub Order Id #</th>
        <th>Vendor Name</th>
        <th>Customer Name</th>
        <th>Product Name</th>
        <th>Product Model</th>

        <th>Product Sku</th>
        <th>Product Price</th>
        <th>Order Date</th>
        {{-- <th>Shipping Date</th> --}}
        <th>Image</th>
        <th>Status</th>
        <th>Action</th>
    </tr>
</tfoot>
@elseif (Route::currentRouteName() == 'pendingorders')
<thead>
    {{-- <th>Sr No</th> --}}
    <th>Order Id#</th>
    <th>Sub Order Id #</th>
    <th>Vendor Name</th>
    <th>Customer Name</th>
    <th>Product Name</th>
    <th>Product Model</th>
    <th>Product Sku</th>
    <th>Product Price</th>
    <th>Order Date</th>
    {{-- <th>Shipping Date</th> --}}
    <th>Image</th>
    <th>Status</th>
    <th>Action</th>
</thead>
<tbody>
    @foreach ($data as $value => $orders)
    <tr>

        {{-- <td>{{ $value + 1 }}</td> --}}

        <td>{{ $orders->order_id }}</td>
        <td>{{ $orders->id }}</td>
        <td>{{ $orders->vendor->name ?? null }}</td>
        <td>{{ $orders->order->first_name  ?? null }} {{ $orders->order->last_name ?? null}}</td>

        <td>{{ $orders->product->name ?? null }} </td>
        <td>{{ $orders->product->model_no ?? null }} </td>
        <td>{{ $orders->product->sku ?? null }} </td>
        <!-- <td>{{ $orders->product->new_sale_price ?? null }} </td> -->
        <td>{{ $orders->p_price ?? null }} </td>
        {{-- <td>{{ $orders->first_name }}</td> --}}

        {{-- <td>{{ $orders->last_name }}</td> --}}

        <td>{{ $orders->created_at }}</td>
        <td>
            {{-- @if ($orders->product->url) --}}
            <img src="{{ $orders->product->url ?? null }}  " loading="lazy" width="50" height="50" alt="Placeholder Image">
            {{-- @else --}}
        </td>
        {{-- <td>{{ $orders->shipping }}</td> --}}
        {{-- <td>
            @if ($orders->product)
            @if ($orders->product->url)
            <img src="{{ $product->product_image->url }}" loading="lazy" width="50" height="50" alt="Placeholder Image" - Order ID:
        {{ $orders->id }}">
        <p>Order ID: {{ $orders->id }}</p>
        @else
        @if ($orders->product->product_image)
        <img src="{{ $product->product_image->url }}" loading="lazy" width="50" height="50" alt="Placeholder Image" - Order ID:
            {{ $orders->id }}">
        <p>Order ID: {{ $orders->id }}</p>
        @endif
        @endif
        @else
        <img src="{{ asset('path-to-your-placeholder-image.jpg') }}" loading="lazy" width="50" height="50" alt="Placeholder Image">
        <p>No image available</p>
        @endif
        </td> --}}

        <form method="POST" action="{{ route('order_details_status', ['id' => $orders->id]) }}">

            @csrf

            @method('PATCH')
            {{-- <input type="text" name="id" value="{{ $orders->order_id }}" /> --}}
            <td>
                <select class="form-control" name="status" id="status{{ $orders->id }}">
                    <option value="{{ $orders->status }}" selected disabled>{{ $orders->status }}</option>
                    <option value="In Process">In Process</option>
                    <option value="Packaging">Packaging</option>
                    <option value="Confirmed">Confirmed</option>
                    <option value="Out of delivery">Out of Delivery</option>
                    <option value="Delivered">Delivered</option>
                    <option value="Failed to Deliver">Failed to Deliver</option>
                    <option value="Returned">Returned</option>
                    <option value="Canceled">Canceled</option>


                </select>
            </td>

            <td class="d-flex  ">

                {{-- <input type="hidden" value="{{ $orders->id }}" name="order_id" hidden> --}}

                <button type="submit" class="btn btn-outline-secondary ladda-button example-button m-1"
                    data-style="expand-left"><span class="ladda-label">Update</span></button>

                <a href="{{ url('get_order_detail_status/' . $orders->id) }}" class="btn btn-outline-secondary"><i
                        class="nav-icon i-Eye "></i></a>
                </div>

            </td>

        </form>

    </tr>
    @endforeach
</tbody>
<tfoot>
    <tr>
        {{-- <th>Sr No</th> --}}
        <th>Order Id#</th>
        <th>Sub Order Id #</th>
        <th>Vendor Name</th>
        <th>Customer Name</th>
        <th>Product Name</th>
        <th>Product Model</th>
        <th>Product Sku</th>
        <th>Product Price</th>
        <th>Order Date</th>
        {{-- <th>Shipping Date</th> --}}
        <th>Image</th>
        <th>Status</th>
        <th>Action</th>
    </tr>
</tfoot>
@elseif (Route::currentRouteName() == 'confirmedorders')
<thead>
    {{-- <th>Sr No</th> --}}
    <th>Order Id#</th>
    <th>Sub Order Id #</th>
    <th>Vendor Name</th>
    <th>Customer Name</th>
    <th>Product Name</th>
    <th>Product Model</th>
    <th>Product Sku</th>
    <th>Product Price</th>
    <th>Order Date</th>
    {{-- <th>Shipping Date</th> --}}
    <th>Image</th>
    <th>Status</th>
    <th>Action</th>
</thead>
<tbody>
    @foreach ($data as $value => $orders)
    <tr>

        {{-- <td>{{ $value + 1 }}</td> --}}

        <td>{{ $orders->order_id }}</td>
        <td>{{ $orders->id }}</td>
        <td>{{ $orders->vendor->name ?? null }}</td>
        <td>{{ $orders->order->first_name  ?? null }} {{ $orders->order->last_name ?? null}}</td>

        <td>{{ $orders->product->name ?? null }} </td>
        <td>{{ $orders->product->model_no ?? null }} </td>
        <td>{{ $orders->product->sku ?? null }} </td>
        <!-- <td>{{ $orders->product->new_sale_price ?? null }} </td> -->
        <td>{{ $orders->p_price ?? null }} </td>
        {{-- <td>{{ $orders->first_name }}</td> --}}

        {{-- <td>{{ $orders->last_name }}</td> --}}

        <td>{{ $orders->created_at }}</td>
        <td>
            {{-- @if ($orders->product->url) --}}
            <img src="{{ $orders->product->url ?? null }}  " loading="lazy" width="50" height="50" alt="Placeholder Image">
            {{-- @else --}}
        </td>
        {{-- <td>{{ $orders->shipping }}</td> --}}
        {{-- <td>
            @if ($orders->product)
            @if ($orders->product->url)
            <img src="{{ $product->product_image->url }}" loading="lazy" width="50" height="50" alt="Placeholder Image" - Order ID:
        {{ $orders->id }}">
        <p>Order ID: {{ $orders->id }}</p>
        @else
        @if ($orders->product->product_image)
        <img src="{{ $product->product_image->url }}" width="50" loading="lazy" height="50" alt="Placeholder Image" - Order ID:
            {{ $orders->id }}">
        <p>Order ID: {{ $orders->id }}</p>
        @endif
        @endif
        @else
        <img src="{{ asset('path-to-your-placeholder-image.jpg') }}" loading="lazy" width="50" height="50" alt="Placeholder Image">
        <p>No image available</p>
        @endif
        </td> --}}

        <form method="POST" action="{{ route('order_details_status', ['id' => $orders->id]) }}">

            @csrf

            @method('PATCH')
            {{-- <input type="text" name="id" value="{{ $orders->order_id }}" /> --}}
            <td>
                <select class="form-control" name="status" id="status{{ $orders->id }}">
                    <option value="{{ $orders->status }}" selected disabled>{{ $orders->status }}</option>
                    <option value="In Process">In Process</option>
                    <option value="Packaging">Packaging</option>
                    <option value="Confirmed">Confirmed</option>
                    <option value="Out of delivery">Out of Delivery</option>
                    <option value="Delivered">Delivered</option>
                    <option value="Failed to Deliver">Failed to Deliver</option>
                    <option value="Returned">Returned</option>
                    <option value="Canceled">Canceled</option>


                </select>
            </td>

            <td class="d-flex 2">

                {{-- <input type="hidden" value="{{ $orders->id }}" name="order_id" hidden> --}}

                <button type="submit" class="btn btn-outline-secondary ladda-button example-button m-1"
                    data-style="expand-left"><span class="ladda-label">Update</span></button>


                </div>

            </td>

        </form>

    </tr>
    @endforeach
</tbody>
<tfoot>
    <tr>
        {{-- <th>Sr No</th> --}}
        <th>Order Id#</th>
        <th>Sub Order Id #</th>
        <th>Vendor Name</th>
        <th>Customer Name</th>
        <th>Product Name</th>
        <th>Product Model</th>
        <th>Product Sku</th>
        <th>Product Price</th>
        <th>Order Date</th>
        {{-- <th>Shipping Date</th> --}}
        <th>Image</th>
        <th>Status</th>
        <th>Action</th>
    </tr>
</tfoot>
@elseif (Route::currentRouteName() == 'packagingorders')
<thead>
    {{-- <th>Sr No</th> --}}
    <th>Order Id#</th>
    <th>Sub Order Id #</th>
    <th>Vendor Name</th>
    <th>Customer Name</th>

    <th>Product Name</th>
    <th>Product Model</th>
    <th>Product Sku</th>
    <th>Product Price</th>
    <th>Order Date</th>
    {{-- <th>Shipping Date</th> --}}
    <th>Image</th>
    <th>Status</th>
    <th>Action</th>
</thead>
<tbody>
    @foreach ($data as $value => $orders)
    <tr>

        {{-- <td>{{ $value + 1 }}</td> --}}

        <td>{{ $orders->order_id }}</td>
        <td>{{ $orders->id }}</td>
        <td>{{ $orders->vendor->name ?? null }}</td>
        <td>{{ $orders->order->first_name  ?? null }} {{ $orders->order->last_name ?? null}}</td>

        <td>{{ $orders->product->name ?? null }} </td>
        <td>{{ $orders->product->model_no ?? null }} </td>
        <td>{{ $orders->product->sku ?? null }} </td>
        <!-- <td>{{ $orders->product->new_sale_price ?? null }} </td> -->
        <td>{{ $orders->p_price ?? null }} </td>
        {{-- <td>{{ $orders->first_name }}</td> --}}

        {{-- <td>{{ $orders->last_name }}</td> --}}

        <td>{{ $orders->created_at }}</td>
        <td>
            {{-- @if ($orders->product->url) --}}
            <img src="{{ $orders->product->url ?? null }}  " loading="lazy" width="50" height="50" alt="Placeholder Image">
            {{-- @else --}}
        </td>
        {{-- <td>{{ $orders->shipping }}</td> --}}
        {{-- <td>
            @if ($orders->product)
            @if ($orders->product->url)
            <img src="{{ $product->product_image->url }}" width="50" height="50" alt="Placeholder Image" - Order ID:
        {{ $orders->id }}">
        <p>Order ID: {{ $orders->id }}</p>
        @else
        @if ($orders->product->product_image)
        <img src="{{ $product->product_image->url }}" width="50" height="50" alt="Placeholder Image" - Order ID:
            {{ $orders->id }}">
        <p>Order ID: {{ $orders->id }}</p>
        @endif
        @endif
        @else
        <img src="{{ asset('path-to-your-placeholder-image.jpg') }}" width="50" height="50" alt="Placeholder Image">
        <p>No image available</p>
        @endif
        </td> --}}

        <form method="POST" action="{{ route('order_details_status', ['id' => $orders->id]) }}">

            @csrf

            @method('PATCH')
            {{-- <input type="text" name="id" value="{{ $orders->order_id }}" /> --}}
            <td>
                <select class="form-control" name="status" id="status{{ $orders->id }}">
                    <option value="{{ $orders->status }}" selected disabled>{{ $orders->status }}</option>
                    <option value="In Process">In Process</option>
                    <option value="Packaging">Packaging</option>
                    <option value="Confirmed">Confirmed</option>
                    <option value="Out of delivery">Out of Delivery</option>
                    <option value="Delivered">Delivered</option>
                    <option value="Failed to Deliver">Failed to Deliver</option>
                    <option value="Returned">Returned</option>
                    <option value="Canceled">Canceled</option>


                </select>
            </td>

            <td class="d-flex 2">

                {{-- <input type="hidden" value="{{ $orders->id }}" name="order_id" hidden> --}}

                <button type="submit" class="btn btn-outline-secondary ladda-button example-button m-1"
                    data-style="expand-left"><span class="ladda-label">Update</span></button>


                </div>

            </td>

        </form>

    </tr>
    @endforeach
</tbody>
<tfoot>
    <tr>
        {{-- <th>Sr No</th> --}}
        <th>Order Id#</th>
        <th>Sub Order Id #</th>
        <th>Vendor Name</th>
        <th>Customer Name</th>
        <th>Product Name</th>
        <th>Product Model</th>
        <th>Product Sku</th>
        <th>Product Price</th>
        <th>Order Date</th>
        {{-- <th>Shipping Date</th> --}}
        <th>Image</th>
        <th>Status</th>
        <th>Action</th>
    </tr>
</tfoot>
@elseif (Route::currentRouteName() == 'outofdelivery')
<thead>
    {{-- <th>Sr No</th> --}}
    <th>Order Id#</th>
    <th>Sub Order Id #</th>
    <th>Vendor Name</th>
    <th>Customer Name</th>
    <th>Product Name</th>
    <th>Product Model</th>
    <th>Product Sku</th>
    <th>Product Price</th>
    <th>Order Date</th>
    {{-- <th>Shipping Date</th> --}}
    <th>Image</th>
    <th>Status</th>
    <th>Action</th>
    <th>View Status</th>

</thead>
<tbody>
    @foreach ($data as $value => $orders)
    <tr>

        {{-- <td>{{ $value + 1 }}</td> --}}

        <td>{{ $orders->order_id }}</td>
        <td>{{ $orders->id }}</td>
        <td>{{ $orders->vendor->name ?? null }}</td>
        <td>{{ $orders->order->first_name  ?? null }} {{ $orders->order->last_name ?? null}}</td>

        <td>{{ $orders->product->name ?? null }} </td>
        <td>{{ $orders->product->model_no ?? null }} </td>
        <td>{{ $orders->product->sku ?? null }} </td>
        <!-- <td>{{ $orders->product->new_sale_price ?? null }} </td> -->
        <td>{{ $orders->p_price ?? null }} </td>
        {{-- <td>{{ $orders->first_name }}</td> --}}

        {{-- <td>{{ $orders->last_name }}</td> --}}

        <td>{{ $orders->created_at }}</td>
        <td>
            {{-- @if ($orders->product->url) --}}
            <img src="{{ $orders->product->url ?? null }}  "  loading="lazy" width="50" height="50" alt="Placeholder Image">
            {{-- @else --}}
        </td>
        {{-- <td>{{ $orders->shipping }}</td> --}}
        {{-- <td>
            @if ($orders->product)
            @if ($orders->product->url)
            <img src="{{ $product->product_image->url }}" loading="lazy" width="50" height="50" alt="Placeholder Image" - Order ID:
        {{ $orders->id }}">
        <p>Order ID: {{ $orders->id }}</p>
        @else
        @if ($orders->product->product_image)
        <img src="{{ $product->product_image->url }}" width="50" height="50" alt="Placeholder Image" - Order ID:
            {{ $orders->id }}">
        <p>Order ID: {{ $orders->id }}</p>
        @endif
        @endif
        @else
        <img src="{{ asset('path-to-your-placeholder-image.jpg') }}" width="50" height="50" alt="Placeholder Image">
        <p>No image available</p>
        @endif
        </td> --}}

        <form method="POST" action="{{ route('order_details_status', ['id' => $orders->id]) }}">

            @csrf

            @method('PATCH')
            {{-- <input type="text" name="id" value="{{ $orders->order_id }}" /> --}}
            <td>
                <select class="form-control" name="status" id="status{{ $orders->id }}">
                    <option value="{{ $orders->status }}" selected disabled>{{ $orders->status }}</option>
                    <option value="In Process">In Process</option>
                    <option value="Packaging">Packaging</option>
                    <option value="Confirmed">Confirmed</option>
                    <option value="Out of delivery">Out of Delivery</option>
                    <option value="Delivered">Delivered</option>
                    <option value="Failed to Deliver">Failed to Deliver</option>
                    <option value="Returned">Returned</option>
                    <option value="Canceled">Canceled</option>


                </select>
            </td>

            <td class="d-flex 2">

                {{-- <input type="hidden" value="{{ $orders->id }}" name="order_id" hidden> --}}

                <button type="submit" class="btn btn-outline-secondary ladda-button example-button m-1"
                    data-style="expand-left"><span class="ladda-label">Update</span></button>


                </div>

            </td>

        </form>

    </tr>
    @endforeach
</tbody>
<tfoot>
    <tr>
        {{-- <th>Sr No</th> --}}
        <th>Order Id#</th>
        <th>Sub Order Id #</th>
        <th>Vendor Name</th>
        <th>Customer Name</th>
        <th>Product Name</th>
        <th>Product Model</th>
        <th>Product Sku</th>
        <th>Product Price</th>
        <th>Order Date</th>
        {{-- <th>Shipping Date</th> --}}
        <th>Image</th>
        <th>Status</th>
        <th>Action</th>
    </tr>
</tfoot>
@elseif (Route::currentRouteName() == 'delivered')
<thead>
    <tr>
        {{-- <th>Sr No</th> --}}
        <th>Order Id#</th>
        <th>Sub Order Id #</th>
        <th>Vendor Name</th>
        <th>Customer Name</th>
        <th>Product Name</th>
        <th>Product Model</th>
        <th>Product Sku</th>
        <th>Product Price</th>
        <th>Order Date</th>
        {{-- <th>Shipping Date</th> --}}
        <th>Image</th>
        <th>Status</th>
        <th>Action</th>
        <th>View Status</th>

    </tr>
</thead>
<tbody>
    @foreach ($data as $value => $orders)
    <tr>

        {{-- <td>{{ $value + 1 }}</td> --}}

        <td>{{ $orders->order_id }}</td>
        <td>{{ $orders->id }}</td>
        <td>{{ $orders->vendor->name ?? null }}</td>
        <td>{{ $orders->order->first_name  ?? null }} {{ $orders->order->last_name ?? null}}</td>

        <td>{{ $orders->product->name ?? null }} </td>
        <td>{{ $orders->product->model_no ?? null }} </td>
        <td>{{ $orders->product->sku ?? null }} </td>
        <!-- <td>{{ $orders->product->new_sale_price ?? null }} </td> -->
        <td>{{ $orders->p_price ?? null }} </td>
        {{-- <td>{{ $orders->first_name }}</td> --}}

        {{-- <td>{{ $orders->last_name }}</td> --}}

        <td>{{ $orders->created_at }}</td>
        <td>
            {{-- @if ($orders->product->url) --}}
            <img src="{{ $orders->product->url ?? null }}  " loading="lazy" width="50" height="50" alt="Placeholder Image">
            {{-- @else --}}
        </td>
        {{-- <td>{{ $orders->shipping }}</td> --}}
        {{-- <td>
            @if ($orders->product)
            @if ($orders->product->url)
            <img src="{{ $product->product_image->url }}" width="50" height="50" alt="Placeholder Image" - Order ID:
        {{ $orders->id }}">
        <p>Order ID: {{ $orders->id }}</p>
        @else
        @if ($orders->product->product_image)
        <img src="{{ $product->product_image->url }}" width="50" height="50" alt="Placeholder Image" - Order ID:
            {{ $orders->id }}">
        <p>Order ID: {{ $orders->id }}</p>
        @endif
        @endif
        @else
        <img src="{{ asset('path-to-your-placeholder-image.jpg') }}" width="50" height="50" alt="Placeholder Image">
        <p>No image available</p>
        @endif
        </td> --}}

        <form method="POST" action="{{ route('order_details_status', ['id' => $orders->id]) }}">

            @csrf

            @method('PATCH')
            {{-- <input type="text" name="id" value="{{ $orders->order_id }}" /> --}}
            <td>
                <select class="form-control" name="status" id="status{{ $orders->id }}">
                    <option value="{{ $orders->status }}" selected disabled>{{ $orders->status }}</option>
                    <option value="In Process">In Process</option>
                    <option value="Packaging">Packaging</option>
                    <option value="Confirmed">Confirmed</option>
                    <option value="Out of delivery">Out of Delivery</option>
                    <option value="Delivered">Delivered</option>
                    <option value="Failed to Deliver">Failed to Deliver</option>
                    <option value="Returned">Returned</option>
                    <option value="Canceled">Canceled</option>


                </select>
            </td>

            <td class="d-flex 2">

                {{-- <input type="hidden" value="{{ $orders->id }}" name="order_id" hidden> --}}

                <button type="submit" class="btn btn-outline-secondary ladda-button example-button m-1"
                    data-style="expand-left"><span class="ladda-label">Update</span></button>


            </td>
            <td>
                <a href="{{ url('get_order_detail_status/' . $orders->id) }}" class="btn btn-outline-secondary"><i
                        class="nav-icon i-Eye "></i></a>
            </td>

        </form>

    </tr>
    @endforeach
</tbody>
<tfoot>
    <tr>
        {{-- <th>Sr No</th> --}}
        <th>Order Id#</th>
        <th>Sub Order Id #</th>
        <th>Vendor Name</th>
        <th>Customer Name</th>
        <th>Product Name</th>
        <th>Product Model</th>
        <th>Product Sku</th>
        <th>Product Price</th>
        <th>Order Date</th>
        {{-- <th>Shipping Date</th> --}}
        <th>Image</th>
        <th>Status</th>
        <th>Action</th>
        <th>View Status</th>

    </tr>
</tfoot>
@elseif (Route::currentRouteName() == 'returned')
<thead>
    {{-- <th>Sr No</th> --}}
    <th>Order Id#</th>
    <th>Sub Order Id #</th>
    <th>Vendor Name</th>
    <th>Customer Name</th>
    <th>Product Name</th>
    <th>Product Model</th>
    <th>Product Sku</th>
    <th>Product Price</th>
    <th>Order Date</th>
    {{-- <th>Shipping Date</th> --}}
    <th>Image</th>
    <th>Status</th>
    <th>Action</th>
</thead>
<tbody>
    @foreach ($data as $value => $orders)
    <tr>

        {{-- <td>{{ $value + 1 }}</td> --}}

        <td>{{ $orders->order_id }}</td>
        <td>{{ $orders->id }}</td>
        <td>{{ $orders->vendor->name ?? null }}</td>
        <td>{{ $orders->order->first_name  ?? null }} {{ $orders->order->last_name ?? null}}</td>

        <td>{{ $orders->product->name ?? null }} </td>
        <td>{{ $orders->product->model_no ?? null }} </td>
        <td>{{ $orders->product->sku ?? null }} </td>
        <!-- <td>{{ $orders->product->new_sale_price ?? null }} </td> -->
        <td>{{ $orders->p_price ?? null }} </td>
        {{-- <td>{{ $orders->first_name }}</td> --}}

        {{-- <td>{{ $orders->last_name }}</td> --}}

        <td>{{ $orders->created_at }}</td>
        <td>
            {{-- @if ($orders->product->url) --}}
            <img src="{{ $orders->product->url ?? null }}  "  loading="lazy" width="50" height="50" alt="Placeholder Image">
            {{-- @else --}}
        </td>
        {{-- <td>{{ $orders->shipping }}</td> --}}
        {{-- <td>
            @if ($orders->product)
            @if ($orders->product->url)
            <img src="{{ $product->product_image->url }}"  width="50" height="50" alt="Placeholder Image" - Order ID:
        {{ $orders->id }}">
        <p>Order ID: {{ $orders->id }}</p>
        @else
        @if ($orders->product->product_image)
        <img src="{{ $product->product_image->url }}" width="50" height="50" alt="Placeholder Image" - Order ID:
            {{ $orders->id }}">
        <p>Order ID: {{ $orders->id }}</p>
        @endif
        @endif
        @else
        <img src="{{ asset('path-to-your-placeholder-image.jpg') }}" width="50" height="50" alt="Placeholder Image">
        <p>No image available</p>
        @endif
        </td> --}}

        <form method="POST" action="{{ route('order_details_status', ['id' => $orders->id]) }}">

            @csrf

            @method('PATCH')
            {{-- <input type="text" name="id" value="{{ $orders->order_id }}" /> --}}
            <td>
                <select class="form-control" name="status" id="status{{ $orders->id }}">
                    <option value="{{ $orders->status }}" selected disabled>{{ $orders->status }}</option>
                    <option value="In Process">In Process</option>
                    <option value="Packaging">Packaging</option>
                    <option value="Confirmed">Confirmed</option>
                    <option value="Out of delivery">Out of Delivery</option>
                    <option value="Delivered">Delivered</option>
                    <option value="Failed to Deliver">Failed to Deliver</option>
                    <option value="Returned">Returned</option>
                    <option value="Canceled">Canceled</option>


                </select>
            </td>

            <td class="d-flex 2">

                {{-- <input type="hidden" value="{{ $orders->id }}" name="order_id" hidden> --}}

                <button type="submit" class="btn btn-outline-secondary ladda-button example-button m-1"
                    data-style="expand-left"><span class="ladda-label">Update</span></button>


                </div>

            </td>

        </form>

    </tr>
    @endforeach
</tbody>
<tfoot>
    <tr>
        {{-- <th>Sr No</th> --}}
        <th>Order Id#</th>
        <th>Sub Order Id #</th>
        <th>Vendor Name</th>
        <th>Customer Name</th>
        <th>Product Name</th>
        <th>Product Model</th>
        <th>Product Sku</th>
        <th>Product Price</th>
        <th>Order Date</th>
        {{-- <th>Shipping Date</th> --}}
        <th>Image</th>
        <th>Status</th>
        <th>Action</th>
    </tr>
</tfoot>
@elseif (Route::currentRouteName() == 'ftod')
<thead>
    {{-- <th>Sr No</th> --}}
    <th>Order Id#</th>
    <th>Sub Order Id #</th>
    <th>Vendor Name</th>
    <th>Customer Name</th>

    <th>Product Name</th>
    <th>Product Model</th>
    <th>Product Sku</th>
    <th>Product Price</th>
    <th>Order Date</th>
    {{-- <th>Shipping Date</th> --}}
    <th>Image</th>
    <th>Status</th>
    <th>Action</th>
</thead>
<tbody>
    @foreach ($data as $value => $orders)
    <tr>

        {{-- <td>{{ $value + 1 }}</td> --}}

        <td>{{ $orders->order_id }}</td>
        <td>{{ $orders->id }}</td>
        <td>{{ $orders->vendor->name ?? null }}</td>
        <td>{{ $orders->order->first_name  ?? null }} {{ $orders->order->last_name ?? null}}</td>

        <td>{{ $orders->product->name ?? null }} </td>
        <td>{{ $orders->product->model_no ?? null }} </td>
        <td>{{ $orders->product->sku ?? null }} </td>
        <!-- <td>{{ $orders->product->new_sale_price ?? null }} </td> -->
        <td>{{ $orders->p_price ?? null }} </td>
        {{-- <td>{{ $orders->first_name }}</td> --}}

        {{-- <td>{{ $orders->last_name }}</td> --}}

        <td>{{ $orders->created_at }}</td>
        <td>
            {{-- @if ($orders->product->url) --}}
            <img src="{{ $orders->product->url ?? null }}  " loading="lazy" width="50" height="50" alt="Placeholder Image">
            {{-- @else --}}
        </td>
        {{-- <td>{{ $orders->shipping }}</td> --}}
        {{-- <td>
            @if ($orders->product)
            @if ($orders->product->url)
            <img src="{{ $product->product_image->url }}" width="50" height="50" alt="Placeholder Image" - Order ID:
        {{ $orders->id }}">
        <p>Order ID: {{ $orders->id }}</p>
        @else
        @if ($orders->product->product_image)
        <img src="{{ $product->product_image->url }}" width="50" height="50" alt="Placeholder Image" - Order ID:
            {{ $orders->id }}">
        <p>Order ID: {{ $orders->id }}</p>
        @endif
        @endif
        @else
        <img src="{{ asset('path-to-your-placeholder-image.jpg') }}" width="50" height="50" alt="Placeholder Image">
        <p>No image available</p>
        @endif
        </td> --}}

        <form method="POST" action="{{ route('order_details_status', ['id' => $orders->id]) }}">

            @csrf

            @method('PATCH')
            {{-- <input type="text" name="id" value="{{ $orders->order_id }}" /> --}}
            <td>
                <select class="form-control" name="status" id="status{{ $orders->id }}">
                    <option value="{{ $orders->status }}" selected disabled>{{ $orders->status }}</option>
                    <option value="In Process">In Process</option>
                    <option value="Packaging">Packaging</option>
                    <option value="Confirmed">Confirmed</option>
                    <option value="Out of delivery">Out of Delivery</option>
                    <option value="Delivered">Delivered</option>
                    <option value="Failed to Deliver">Failed to Deliver</option>
                    <option value="Returned">Returned</option>
                    <option value="Canceled">Canceled</option>


                </select>
            </td>

            <td class="d-flex 2">

                {{-- <input type="hidden" value="{{ $orders->id }}" name="order_id" hidden> --}}

                <button type="submit" class="btn btn-outline-secondary ladda-button example-button m-1"
                    data-style="expand-left"><span class="ladda-label">Update</span></button>


                </div>

            </td>

        </form>

    </tr>
    @endforeach
</tbody>
<tfoot>
    <tr>
        {{-- <th>Sr No</th> --}}
        <th>Order Id#</th>
        <th>Sub Order Id #</th>
        <th>Vendor Name</th>
        <th>Customer Name</th>
        <th>Product Name</th>
        <th>Product Model</th>
        <th>Product Sku</th>
        <th>Product Price</th>
        <th>Order Date</th>
        {{-- <th>Shipping Date</th> --}}
        <th>Image</th>
        <th>Status</th>
        <th>Action</th>
    </tr>
</tfoot>
@elseif (Route::currentRouteName() == 'canceled')
<thead>
    {{-- <th>Sr No</th> --}}
    <th>Order Id#</th>
    <th>Sub Order Id #</th>
    <th>Vendor Name</th>
    <th>Customer Name</th>
    <th>Product Name</th>
    <th>Product Model</th>
    <th>Product Sku</th>
    <th>Product Price</th>
    <th>Order Date</th>
    {{-- <th>Shipping Date</th> --}}
    <th>Image</th>
    <th>Status</th>
    <th>Action</th>
</thead>
<tbody>
    @foreach ($data as $value => $orders)
    <tr>

        {{-- <td>{{ $value + 1 }}</td> --}}

        <td>{{ $orders->order_id }}</td>
        <td>{{ $orders->id }}</td>
        <td>{{ $orders->vendor->name ?? null }}</td>
        <td>{{ $orders->order->first_name  ?? null }} {{ $orders->order->last_name ?? null}}</td>

        <td>{{ $orders->product->name ?? null }} </td>
        <td>{{ $orders->product->sku ?? null }} </td>
        <td>{{ $orders->product->model_no ?? null }} </td>
        <!-- <td>{{ $orders->product->new_sale_price ?? null }} </td> -->
        <td>{{ $orders->p_price ?? null }} </td>
        {{-- <td>{{ $orders->first_name }}</td> --}}

        {{-- <td>{{ $orders->last_name }}</td> --}}

        <td>{{ $orders->created_at }}</td>
        <td>
            {{-- @if ($orders->product->url) --}}
            <img src="{{ $orders->product->url ?? null }} " loading="lazy" width="50" height="50" alt="Placeholder Image">
            {{-- @else --}}
        </td>
        {{-- <td>{{ $orders->shipping }}</td> --}}
        {{-- <td>
            @if ($orders->product)
            @if ($orders->product->url)
            <img src="{{ $product->product_image->url }}" width="50" height="50" alt="Placeholder Image" - Order ID:
        {{ $orders->id }}">
        <p>Order ID: {{ $orders->id }}</p>
        @else
        @if ($orders->product->product_image)
        <img src="{{ $product->product_image->url }}" width="50" height="50" alt="Placeholder Image" - Order ID:
            {{ $orders->id }}">
        <p>Order ID: {{ $orders->id }}</p>
        @endif
        @endif
        @else
        <img src="{{ asset('path-to-your-placeholder-image.jpg') }}" width="50" height="50" alt="Placeholder Image">
        <p>No image available</p>
        @endif
        </td> --}}

        <form method="POST" action="{{ route('order_details_status', ['id' => $orders->id]) }}">

            @csrf

            @method('PATCH')
            {{-- <input type="text" name="id" value="{{ $orders->order_id }}" /> --}}
            <td>
                <select class="form-control" name="status" id="status{{ $orders->id }}">
                    <option value="{{ $orders->status }}" selected disabled>{{ $orders->status }}</option>
                    <option value="In Process">In Process</option>
                    <option value="Packaging">Packaging</option>
                    <option value="Confirmed">Confirmed</option>
                    <option value="Out of delivery">Out of Delivery</option>
                    <option value="Delivered">Delivered</option>
                    <option value="Failed to Deliver">Failed to Deliver</option>
                    <option value="Returned">Returned</option>
                    <option value="Canceled">Canceled</option>


                </select>
            </td>

            <td class="d-flex 2">

                {{-- <input type="hidden" value="{{ $orders->id }}" name="order_id" hidden> --}}

                <button type="submit" class="btn btn-outline-secondary ladda-button example-button m-1"
                    data-style="expand-left"><span class="ladda-label">Update</span></button>


                </div>

            </td>

        </form>

    </tr>
    @endforeach
</tbody>
<tfoot>
    <tr>
        {{-- <th>Sr No</th> --}}
        <th>Order Id#</th>
        <th>Sub Order Id #</th>
        <th>Vendor Name</th>
        <th>Customer Name</th>
        <th>Product Name</th>
        <th>Product Model</th>
        <th>Product Sku</th>
        <th>Product Price</th>
        <th>Order Date</th>
        {{-- <th>Shipping Date</th> --}}
        <th>Image</th>
        <th>Status</th>
        <th>Action</th>
    </tr>
</tfoot>
{{-- vendor list  --}}
@elseif (Route::currentRouteName() == '1234')
<thead>
    <th>Sr No</th>
    <th>Name wsd</th>
    <th>Phone Number</th>
    <th>Email</th>
    <th>Status</th>
    <th>Action</th>
</thead>
<tbody>
    {{-- @foreach ($data as $data)
        <tr>
            <td>{{$data->id}}</td>
    <td>{{$data->name}}</td>
    <td>{{$data->phone1}}</td>
    <td>{{$data->email}}</td>   
    <td>{{$data->status}}</td>
    <td><a href="{{url('/admin/edit-service/' . $data['id'])}}" class="btn rounded-pill btn-icon btn-secondary"><i
                class="fa fa-pencil-square-o" title="edit" aria-hidden="true"></i></a></td>
    </tr>
    @endforeach --}}

</tbody>
<tfoot>
    <tr>
        <th>Sr No</th>
        <th>Name</th>
        <th>Phone Number</th>
        <th>Email</th>
        <th>Status</th>
        <th>Action</th>
    </tr>
</tfoot>
{{-- vendor list  --}}
@elseif (Route::currentRouteName() == 'vendor.index')
<thead>
    <th>Sr No</th>
    <th>Name</th>
    <th>Phone Number</th>
    <th>Email</th>
    <th>Verified</th>
    <th>Trusted</th>
    <th>Status</th>
    <th>Action</th>
</thead>
<tbody>

    @foreach ($vendor as $value => $vendors)
    <tr>
        {{-- {{-- <td>{{$value + 1}}</td> --}}
        <td>{{ $vendors->id }}</td>
        <td>{{ $vendors->name }}</td>
        <td>{{ $vendors->phone1 }}</td>
        <td>{{ $vendors->email }}</td>
        {{-- <td>{{ $vendors->status}}</td> --}}
        <td>
            @if ($vendors->verified_status == '1')
            <span class="badge  badge-round-success md">
                <p style="font-size: revert;">✓</p>
            </span></h3>
            @elseif ($vendors->verified_status == '0')
            {{-- <span class="badge  badge-round-danger md"><p style="font-size: revert;">X</p></span></h3> --}}
            <h6>x</h6>
            @endif
        </td>
        <td>
            @if ($vendors->trusted_status == '1')
            <span class="badge  badge-round-info md">
                <p style="font-size: revert;">✓</p>
            </span>
            @elseif ($vendors->trusted_status == '0')
            <h6>x</h6>
            {{-- <span class="badge  badge-round-secondary md"><p style="font-size: revert;">x</p></span> --}}
            @endif
        </td>
        <td>
            @if ($vendors->status == '1')
            <span class="badge text-bg-success">Active</span>
            @elseif ($vendors->status == '0')
            <span class="badge text-bg-danger">In_Active</span>
            @endif
        </td>
        <td>
            <div class="d-flex gap-2">
                <a href="{{ URL::to('vendor/' . $vendors->id . '/edit') }}">
                    <button type="button" class="btn btn-outline-secondary ">
                        <i class=" nav-icon i-Pen-2" style="font-weight: bold;"></i>
                    </button>
                </a>

                <a href="{{ route('vendor.show', $vendors->id) }}">
                    <button type="button" class="btn btn-outline-secondary ">
                        <i class="nav-icon i-Eye" style="font-weight: bold;"></i>
                    </button>
                </a>
            </div>
        </td>
    </tr>
    @endforeach

</tbody>
<tfoot>
    <tr>
        <th>Sr No</th>
        <th>Name</th>
        <th>Phone Number</th>
        <th>Email</th>
        <th>Verified</th>
        <th>Trusted</th>
        <th>Status</th>
        <th>Action</th>
    </tr>
</tfoot>
{{-- vendor withdrawl list  --}}
@elseif (Route::currentRouteName() == 'withdrawl')
<thead>
    <th>Sr No</th>
    <th>Name</th>
    <th>Phone Number</th>
    <th>Email</th>
    <th>Status</th>
    <th>Action</th>
</thead>
<tbody>
    <tr>
        <td>Tiger Nixon</td>
        <td>System Architect</td>
        <td>Edinburgh</td>
        <td>61</td>
        <td>2011/04/25</td>
        <td>$320,800</td>
    </tr>
</tbody>
<tfoot>
    <tr>
        <th>Sr No</th>
        <th>Name</th>
        <th>Phone Number</th>
        <th>Email</th>
        <th>Status</th>
        <th>Action</th>
    </tr>
</tfoot>

{{-- Refund tables  --}}
@elseif (Route::currentRouteName() == 'allrefunds')
<thead>
    <th>Sr No</th>
    <th>Vedor</th>
    <th>Product Id#</th>
    <th>Customer Id#</th>
    <th>Order_Id#</th>
    <th>Reason</th>
    <th>Amount</th>
    <th>Status</th>
    <th>Action</th>
</thead>
<tbody>
    @foreach ($refund_status as $key => $value)
    <tr>
        <td>{{ $value->id }}</td>
        <td>{{ $value->Vendor }}</td>
        <td>{{ $value->product->sku ?? null }}</td>
        <td>{{ $value->customer_id }}</td>
        <td>{{ $value->order_id }}</td>
        <td>{{ $value->reason }}</td>
        <td>{{ $value->amount }}</td>
        <form method="POST" action="{{ route('refund.update') }}">
            @csrf
            <td>
                <select class="form-control" id="product_id" name="status">
                    <option value="" selected disabled>{{ $value->status }}</option>
                    <option value="pending">Pending</option>
                    <option value="approved">Approved</option>
                    <option value="refunded">Refunded</option>
                    <option value="rejected">Rejected</option>
                </select>
            </td>
            <td>
                <input type="text" value="{{ $value->id }}" name="id" hidden>
                <button type="submit" class="btn btn-outline-secondary ladda-button example-button m-1"
                    data-style="expand-left"><span class="ladda-label">Update</span></button>
            </td>
        </form>
    </tr>
    @endforeach
</tbody>
<tfoot>
    <tr>
        <th>Sr No</th>
        <th>Vedor</th>
        <th>Product Id#</th>
        <th>Customer Id#</th>
        <th>Order_Id#</th>
        <th>Reason</th>
        <th>Amount</th>
        <th>Status</th>
        <th>Action</th>
    </tr>
</tfoot>
@elseif (Route::currentRouteName() == 'pendingrefund')
<thead>
    <th>Sr No</th>
    <th>ID</th>
    <th>Product</th>
    <th>Product Image(145x66)px</th>
    <th>Order Id</th>
    <th>User Name</th>
    <th>Email</th>
    <th>Amount</th>
    <th>Reason</th>
    <th>Status</th>
</thead>
<tbody>
    @foreach ($refund_status as $key => $refund)
    <tr>
        <td>{{ $key + 1 }}</td>
        <td>{{ $refund->id }}</td>
        <td>
            {{ $refund->product->name ?? null }}
        </td>
        <td>
            <img src="{{ $refund->product->url ?? null }}" loading="lazy" alt="Surprise" width="50" height="50">

        </td>
        <td>
            {{ $refund->order_id }}
        </td>
        <td>{{ $refund->user->name ?? null }}</td>

        <td>{{ $refund->user->email ?? null }}</td>
        <td>{{ $refund->amount }}</td>
        <td>{{ $refund->reason }}</td>
        <td>{{ $refund->status }}</td>

    </tr>
    @endforeach
</tbody>
<tfoot>
    <tr>
        <th>Sr No</th>
        <th>ID</th>
        <th>Product</th>
        <th>Product Image</th>
        <th>Order Id</th>
        <th>User Name</th>
        <th>Email</th>
        <th>Amount</th>
        <th>Reason</th>
        <th>Status</th>
    </tr>
</tfoot>
@elseif (Route::currentRouteName() == 'approvedrefund')
<thead>
    <th>Sr No</th>
    <th>ID</th>
    <th>Product</th>
    <th>Product Image(145x66)px</th>
    <th>Order Id</th>
    <th>User Name</th>
    <th>Email</th>
    <th>Amount</th>
    <th>Reason</th>
    <th>Status</th>
</thead>
<tbody>
    @foreach ($refund_status as $key => $refund)
    <tr>
        <td>{{ $key + 1 }}</td>
        <td>{{ $refund->id }}</td>
        <td>
            {{ $refund->product->name ?? null }}
        </td>
        <td>
            <img src="{{ $refund->product->url }}"  loading="lazy" alt="Surprise" width="50" height="50">

        </td>
        <td>
            {{ $refund->order_id }}
        </td>
        <td>{{ $refund->user->name ?? null }}</td>

        <td>{{ $refund->user->email ?? null }}</td>
        <td>{{ $refund->amount }}</td>
        <td>{{ $refund->reason }}</td>
        <td>{{ $refund->status }}</td>


    </tr>
    @endforeach
</tbody>
<tfoot>
    <tr>
        <th>Sr No</th>
        <th>ID</th>
        <th>Product</th>
        <th>Product Image</th>
        <th>Order Id</th>
        <th>User Name</th>
        <th>Email</th>
        <th>Amount</th>
        <th>Reason</th>
        <th>Status</th>
    </tr>
</tfoot>
@elseif (Route::currentRouteName() == 'refunded')
<thead>
    <th>Sr No</th>
    <th>ID</th>
    <th>Product</th>
    <th>Product Image(145x66)px</th>
    <th>Order Id</th>
    <th>User Name</th>
    <th>Email</th>
    <th>Amount</th>
    <th>Reason</th>
    <th>Status</th>
</thead>
<tbody>
    @foreach ($refund_status as $key => $refund)
    <tr>
        <td>{{ $key + 1 }}</td>
        <td>{{ $refund->id }}</td>
        <td>
            {{ $refund->product->name ?? null }}
        </td>
        <td>
            <img src="{{ $refund->product->url ?? null }}"  loading="lazy" alt="Surprise" width="50" height="50">

        </td>
        <td>
            {{ $refund->order_id }}
        </td>
        <td>{{ $refund->user->name ?? null }}</td>

        <td>{{ $refund->user->email ?? null }}</td>
        <td>{{ $refund->amount }}</td>
        <td>{{ $refund->reason }}</td>
        <td>{{ $refund->status }}</td>


    </tr>
    @endforeach
</tbody>
<tfoot>
    <tr>
        <th>Sr No</th>
        <th>ID</th>
        <th>Product</th>
        <th>Product Image</th>
        <th>Order Id</th>
        <th>User Name</th>
        <th>Email</th>
        <th>Amount</th>
        <th>Reason</th>
        <th>Status</th>
    </tr>
</tfoot>
@elseif (Route::currentRouteName() == 'refundrejected')
<thead>
    <th>Sr No</th>
    <th>ID</th>
    <th>Product</th>
    <th>Product Image(145x66)px</th>
    <th>Order Id</th>
    <th>User Name</th>
    <th>Email</th>
    <th>Amount</th>
    <th>Reason</th>
    <th>Status</th>
</thead>
<tbody>
    @foreach ($refund_status as $key => $refund)
    <tr>
        <td>{{ $key + 1 }}</td>
        <td>{{ $refund->id }}</td>
        <td>
            {{ $refund->product->name ?? null }}
        </td>
        <td>
            <img src="{{ $refund->product->url ?? null }}" alt="Surprise" width="50" height="50">

        </td>
        <td>
            {{ $refund->order_id }}
        </td>
        <td>{{ $refund->user->name ?? null }}</td>

        {{-- <td>{{ $refund->product->url }}</td> --}}
        <td>{{ $refund->user->email ?? null }}</td>
        <td>{{ $refund->amount }}</td>
        <td>{{ $refund->reason }}</td>
        <td>{{ $refund->status }}</td>


        {{-- <td><span class="i-Eye-Visible"></span>
        </td> --}}
    </tr>
    @endforeach
</tbody>
<tfoot>
    <tr>
        <th>Sr No</th>
        <th>ID</th>
        <th>Product</th>
        <th>Product Image(145x66)px</th>
        <th>Order Id</th>
        <th>User Name</th>
        <th>Email</th>
        <th>Amount</th>
        <th>Reason</th>
        <th>Status</th>
    </tr>
</tfoot>
@elseif (Route::currentRouteName() == 'refundrejected')
<thead>
    <th>Sr No</th>
    <th>ID</th>
    <th>Product</th>
    <th>Product Image(145x66)px</th>
    <th>Order Id</th>
    <th>User Name</th>
    <th>Email</th>
    <th>Amount</th>
    <th>Reason</th>
    <th>Status</th>
</thead>
<tbody>
    @foreach ($refund_status as $key => $refund)
    <tr>
        <td>{{ $key + 1 }}</td>
        <td>{{ $refund->id }}</td>
        <td>
            {{ $refund->product->name ?? null }}
        </td>
        <td>
            <img src="{{ $refund->product->url ?? null }}" alt="Surprise" width="50" height="50">

        </td>
        <td>
            {{ $refund->order_id }}
        </td>
        <td>{{ $refund->user->name ?? null }}</td>

        {{-- <td>{{ $refund->product->url }}</td> --}}
        <td>{{ $refund->user->email ?? null }}</td>
        <td>{{ $refund->amount }}</td>
        <td>{{ $refund->reason }}</td>
        <td>{{ $refund->status }}</td>


        {{-- <td><span class="i-Eye-Visible"></span>
        </td> --}}
    </tr>
    @endforeach
</tbody>
<tfoot>
    <tr>
        <th>Sr No</th>
        <th>ID</th>
        <th>Product</th>
        <th>Product Image</th>
        <th>Order Id</th>
        <th>User Name</th>
        <th>Email</th>
        <th>Amount</th>
        <th>Reason</th>
        <th>Status</th>
    </tr>
</tfoot>


{{-- customer related tables  --}}
@elseif (Route::currentRouteName() == 'customerlist')
<thead>
    <th>Sr No</th>
    <th>Customer Name</th>

    <th>Phone Number</th>
    <th>Email</th>
    <th>Gender</th>
</thead>
<tbody>
    @foreach ($customer as $value => $customers)
    <tr>
        {{-- <td>{{$value + 1}}</td> --}}
        <td>{{ $customers->id }}</td>
        <td>{{ $customers->first_name }}</td>
        <td>{{ $customers->last_name }}</td>
        <td>{{ $customers->phone1 }}</td>
        <td>{{ $customers->email }}</td>
        <td>{{ $customers->gender }}</td>
    </tr>
    @endforeach
</tbody>
<tfoot>
    <tr>
        <th>Sr No</th>
        <th>Customer Name</th>
        <th>Phone Number</th>
        <th>Email</th>
        <th>Gender</th>
    </tr>
</tfoot>
@elseif (Route::currentRouteName() == 'userlist')
<thead>
    <tr>
        <th>Id</th>
        <th>Name</th>
        <th>Email</th>
        <th>Contact</th>
        <th>Country</th>
        <th>City</th>
        <th>Address</th>
        <th>gender</th>
        <th>Action</th>
    </tr>
</thead>
<tbody>
    @foreach ($users as $user)
    <tr>
        <td>{{ $user->id }}</td>
        <td>{{ $user->name }}</td>
        <td>{{ $user->email }}</td>
        <td>{{ $user->phone }}</td>
        <td>{{ $user->country }}</td>
        <td>{{ $user->city }}</td>
        <td>{{ $user->addres }}</td>
        <td>{{ $user->gender }}</td>
        <td>
            <a href="{{ route('user.edit', ['id' => $user->id]) }}"
                class="btn rounded-pill btn-icon btn-outline-secondary">
                <i class="fa fa-pencil-square-o" title="edit" aria-hidden="true"></i>
            </a>
        </td>
    </tr>
    @endforeach
</tbody>
<tfoot>
    <tr>
        <th>Id</th>
        <th>Name</th>
        <th>Email</th>
        <th>Contact</th>
        <th>Country</th>
        <th>City</th>
        <th>Address</th>
        <th>gender</th>
        <th>Action</th>
    </tr>
</tfoot>


{{-- product secondary  --}}
@elseif (Route::currentRouteName() == 'products.index')
<thead>
    <th>Sr No</th>
    <th>Name</th>
    <th>Model#</th>
    <th>SKU</th>
    <th>Category</th>
    <th>Supplier</th>
    <th>Image(145x66)px</th>
    {{-- <th>Type</th> --}}
    <th>Action</th>
</thead>
<tbody>
    @foreach ($data as $key => $product)
    <tr>
        <td>{{ $key + 1 }}</td>
        <td>{{ $product->name }}</td>
        <td>{{ $product->model_no }}</td>


        <td>{{ $product->sku }}</td>
        <td>
            @if ($product->categories)
            {{ $product->categories->name ?? null }}
            @endif
            ,
            @if ($product->subcategories)
            {{ $product->subcategories->name ?? null }}
            @endif
        </td>
        <td>{{ $product->make }}</td>
            @if ($product->url)
                <td><img src="{{ $product->url }}" width="50" height="50" loading="lazy"></td>
            @elseif($product->product_image)
                <td><img src="{{ $product->product_image->url ?? null }}" width="50" height="50" loading="lazy"></td>
            @else
                <td>image</td>
            @endif

        <td>

            <div class="d-flex gap-2">
                <a target="_blank" href="{{ URL::to('products/' . $product->id . '/edit') }}"><button type="button"
                        class="btn btn-outline-secondary ">
                        <i {{-- class="fa fa-clone" --}} class=" nav-icon i-Pen-2" title="edit"
                            style="font-weight: bold;"></i>
                    </button></a>
                <a target="_blank" href="{{ URL::to('product/' . $product->id . '/dupe') }}"><button type="button"
                        class="btn btn-outline-secondary ">
                        <i class="fa fa-clone" {{-- class="nav-icon i-Duplicate-Window" --}} title="dupl"
                            style="font-weight: bold;"></i>
                    </button></a>
                <a href="https://www.industrymall.net/product-details/{{ $product->id }}" target="_blank"
                    class="btn btn-outline-secondary">
                    <i class="nav-icon i-Eye" title="view"></i>
                </a>


            </div>

        </td>
        <td class="d-none"> {{ $product->created_at }}</td>

    </tr>
    @endforeach
</tbody>
<tfoot>
    <tr>
        <th>Sr No</th>
        <th>Name</th>
        <th>Model#</th>
        <th>SKU</th>
        <th>Category</th>
        <th>Supplier</th>
        <th>image(145x66)px</th>
        {{-- <th>Type</th> --}}
        <th>Action</th>
    </tr>
</tfoot>
@elseif (Route::currentRouteName() == 'CustomerQueries.index')
<thead>
    <th>Sr#</th>
    <th>Person/Company Name</th>
    <th>Product Name</th>
    <th>Model#</th>
    <th>Email:</th>
    <th>Website:</th>
    <th>Contact Number</th>
    <th>Supplier Name</th>
    <th>Address</th>
    <th>Message</th>
    <th>Action</th>
</thead>
<tbody>
    @foreach ($data as $key => $value)
    <tr>
        <td>{{ $key + 1 }}</td>
        <td>{{ $value->make }}</td>
        <td>{{ $value->pro_name }}</td>
        <td>{{ $value->model_no }}</td>
        <td>{{ $value->email }}</td>
        <td>{{ $value->website }}</td>
        <td>{{ $value->phoneno }}</td>
        <td>{{ $value->vendor->name ?? null }}</td>
        <td>{{ $value->address }}</td>
        {{-- <td>{{ Str::limit($value["message"], 30) }}</td> --}}
        {{-- <td>{{ $value->message }}</td> --}}

        <td>
            <div class="tooltip-container">
                <span class="message-hover">{{ Str::limit($value->message, 30) }}</span>
                <div class="tooltip">{{ $value->message }}</div>
            </div>
        </td>
        <td>
            <div class="d-flex gap-2">
                <a target="_blank" href="{{ route('CustomerQueries.show', $value->id) }}">
                    <button type="button" class="btn btn btn-outline-secondary ">
                        <i class="nav-icon i-Eye" title="view" style="font-weight: bold;"></i>
                    </button></a>


                <a target="_blank" href="mailto:{{ $value->email }}">
                    <button type="button" class="btn btn btn-outline-secondary ">
                        <i class="nav-icon i-Email" title="email" style="font-weight: bold;"></i>
                    </button></a>
            </div>
        </td>
    </tr>
    @endforeach


</tbody>
<tfoot>
    <tr>
        <th>Sr#</th>
        <th>Person/Company Name</th>
        <th>Product Name</th>
        <th>Model#</th>
        <th>Email:</th>
        <th>Website:</th>
        <th>Contact Number</th>
        <th>Supplier Name</th>
        <th>Address</th>
        <th>Message</th>
        <th>Action</th>
    </tr>
</tfoot>
@elseif (Route::currentRouteName() == 'productreviews')
<thead>
    <th>Sr No</th>
    <th>Customer Name</th>
    <th>Model#</th>
    <th>SKU</th>
    <th>Rating</th>
    <th>Comments</th>
    <th>Image(145x66)px</th>
    <th>Date</th>
    <th>Action</th>
</thead>
<tbody>
    <tr>
        <td>1</td>
        <td>Tiger Nixon</td>
        <td>System Architect</td>
        <td>Edinburgh</td>
        <td class="star-rating">
            <span class="star star-filled"></span>&nbsp;&nbsp;
            <span class="star star-filled"></span>&nbsp;&nbsp;
            <span class="star star-filled"></span>&nbsp;&nbsp;
            <span class="star star-filled"></span>&nbsp;&nbsp;
            <span class="star star-partial"></span>&nbsp;&nbsp;
        </td>
        <td>This product is too good</td>
        <td><img src="" width="50" height="50"></td>
        <td>2011/04/25</td>
        <td> <a href="">
                <button type="button" class="btn btn-outline-secondary ">
                    <i class="nav-icon i-Eye" title="view" style="font-weight: bold;"></i>
                </button>
            </a></td>
    </tr>
</tbody>

<tfoot>
    <tr>
        <th>Sr No</th>
        <th>Customer Name</th>
        <th>Model#</th>
        <th>SKU</th>
        <th>Rating</th>
        <th>Comments</th>
        <th>Image (145x66)px</th>
        <th>Date</th>
        <th>Action</th>
    </tr>
</tfoot>
@elseif (Route::currentRouteName() == 'creviews')
<thead>
    <th>Sr No</th>
    <th>Product Id#</th>
    <th>Customer Name</th>
    <th>Customer Email</th>
    <th>Reviews</th>
    <th>Rating</th>
    <th>Image(160x80)px</th>
    <th>Action</th>
</thead>
<tbody>
    @foreach ($Reviews as $key => $review)
    <tr>
        <td>{{ $key + 1 }}</td>
        <td>{{ $review->product_id }}</td>
        <td>{{ $review->customer_name }}</td>
        <td>{{ $review->customer_email }}</td>
        <td>{{ $review->review }}</td>
        <td>
            @php
            $rating = $review->rating;
            @endphp

            <div class="rating d-flex flex-direction-right">
                @for ($i = 1; $i <= 5; $i++) <!-- <i class="nav-icon i-David-Star"
                    style="color: {{ $i <= $rating ? '#f5c60b' : '#ccc' }}; font-size: 10px; margin-right: 5px;"></i>
                    -->
                    <i class="nav-icon star-icon"
                        style="color: {{ $i <= $rating ? '#f5c60b' : '#ccc' }} font-size: 25px;"></i>
                    @endfor
            </div>
        </td>
        <td><img src="" width="50" height="50"></td>
        <td> <a target="_blank" href="">
                <button type="button" class="btn btn btn-outline-secondary ">
                    <i class="nav-icon i-Eye" title="view" style="font-weight: bold;"></i>
                </button></a></td>
    </tr>
    @endforeach
</tbody>
<tfoot>
    <tr>
        <th>Sr No</th>
        <th>Product Id#</th>
        <th>Customer Name</th>
        <th>Customer Email</th>
        <th>Reviews</th>
        <th>Rating</th>

    </tr>
</tfoot>
@elseif (Route::currentRouteName() == 'cwallet')
<thead>
    <th>Sr No</th>
    <th>Transcation Id</th>
    <th>Customer</th>
    <th>Credit</th>
    <th>Debit </th>
    <th>Balance</th>
    <th>Transcation type</th>
    <th>Reference</th>
</thead>
<tbody>
    <tr>
        <td>Sr No</td>
        <td>2343</td>
        <td>Ali</td>
        <td>27</td>
        <td>32</td>
        <td>123</td>
        <td>Order place</td>
        <td>order payment</td>
    </tr>
    <tr>
        <td>Sr No</td>
        <td>2343</td>
        <td>Waqas</td>
        <td>234</td>
        <td>645</td>
        <td>164</td>
        <td>Order place</td>
        <td>order payment</td>
    </tr>
</tbody>
<tfoot>
    <tr>
        <th>Sr No</th>
        <th>Transcation Id</th>
        <th>Customer</th>
        <th>Credit</th>
        <th>Debit </th>
        <th>Balance</th>
        <th>Transcation type</th>
        <th>Reference</th>
    </tr>
</tfoot>
@elseif (Route::currentRouteName() == 'allmenu')
<thead>
    <th>Sr No</th>
    <th>Id#</th>
    <th>Name</th>
    <th>Icon</th>
    <th>Action</th>
</thead>
<tbody>
    @foreach ($data as $key => $menu)
    <tr class="col-lg-11">
        <td>{{ $key + 1 }}</td>
        <td>{{ $menu->id }}</td>
        <td>{{ $menu->name }}</td>
        <td><i class="{{ $menu->icon }}" style='color:#5233ff; font-size: 30px; margin-right: 10px;'></i>
        </td>
        <td class="col-lg-1" style="white-space: nowrap;">
            <a href="{{ route('menu.edit', ['id' => $menu->id]) }}" class="btn  btn-outline-secondary">
                <i class=" nav-icon i-Pen-2" style="font-weight: bold;"></i>
            </a>

            {{-- <form action="{{ route('menu.destroy', ['id' => $menu->id]) }}" method="POST"
            onsubmit="return confirm('Are you sure you want to delete this menu item?')"
            style="display: inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-outline-secondary">
                <i class="fa fa-trash" title="delete" aria-hidden="true"></i>
            </button>
            </form> --}}
        </td>

    </tr>
    @endforeach
</tbody>
<tfoot>
    <tr>
        <th>Sr No</th>
        <th>Id#</th>
        <th>Name</th>
        <th>Icon</th>
    </tr>
</tfoot>
@elseif (Route::currentRouteName() == 'addmenu')
<thead>
    <th>Sr No</th>
    <th>Id#</th>
    <th>Name</th>
    <th>Icon</th>
    {{-- <th>image</th>
        <th>imageforapp</th> --}}

</thead>
<tbody>
    @foreach ($data as $key => $menu)
    <tr>
        <td>{{ $key + 1 }}</td>
        <td>{{ $menu->id }}</td>
        <td>{{ $menu->name }}</td>
        <td><i class="{{ $menu->icon }}" style='color:#5233ff;  font-size: 30px;margin-right: 10px;'></i>
        </td>
        {{-- <td><i class="{{ $menu->icon }}"></i></td> --}}
        @endforeach
</tbody>
@elseif (Route::currentRouteName() == 'allcat')
<thead>
    <th>Sr No</th>
    <th>Id#</th>
    <th>Name</th>
    <th>Menu</th>
    {{-- <th>Commission</th> --}}
    <th>Image(160x80)px</th>
    <th>Images for App(160x80)px</th>
    <th>Action</th>
</thead>
<tbody>

    @foreach ($data as $key => $allcat)
    <tr>
        <td>{{ $key + 1 }}</td>
        <td>{{ $allcat->id }}</td>
        <td>{{ $allcat->name }}</td>
        <td>
            @php
            $menu = $menus->where('id', $allcat->menu_id)->first();
            @endphp
            @if ($menu)
            {{ $menu->name }}
            @else
            No menu found
            @endif
        </td>
        {{-- <td>{{ $allcat->commission }}</td> --}}
        <td><img src="<?php echo $allcat['img']; ?>" width="50" height="50" loading="lazy"></td>
        <td><img src="<?php echo $allcat['imageforapp']; ?>" width="50" height="50" loading="lazy"></td>
        <td class="col-lg-1" style="white-space: nowrap;">
            <a href="{{ route('category.editcat', ['id' => $allcat->id]) }}" class="btn  btn-outline-secondary">
                <i class=" nav-icon i-Pen-2" title="edit" style="font-weight: bold;"></i>
            </a>
        </td>
    </tr>
    @endforeach

</tbody>

<tfoot>
    <th>Sr No</th>
    <th>Id#</th>
    <th>Name</th>
    <th>Menu</th>
    {{-- <th>Commission</th> --}}
    <th>Image(100x66)px</th>
    <th>Images for App(100x66)px</th>

   

    <th>Action</th>
</tfoot>
@elseif (Route::currentRouteName() == 'sub-category.index')
<thead>
    <tr>
        <th>Sr</th>
        <th>Name</th>
        <th>Category</th>
        <th>Image(130x60)px</th>
        <th>Slug</th>
        <th>Commission</th>
        <th>Actions</th>
    </tr>
</thead>
<tbody>
    @foreach ($data as $key => $donor)
    <tr>
        <td>{{ number_format($key + 1) }}</td>
        <td>{{ $donor->name }}</td>
        <td>
            @if ($donor->categories)
            {{ $donor->categories->name ?? null }}
            @endif
        </td>
        <td><img src="{{ asset($donor->img) }}" alt="Subcategory Image" width="80px" height="60px" loading="lazy">
        </td>
        <td>{{ $donor->slug }}</td>
        <td>{{ $donor->commission }}</td>
        <td class="col-lg-1" style="white-space: nowrap;">
            <a href="{{ asset('sub-category') }}/{{ $donor->id }}/edit" class="btn  btn-outline-secondary">
                <i class=" nav-icon i-Pen-2" style="font-weight: bold;"></i>
            </a>
            <form action="{{ route('sub-category.destroy', ['sub_category' => $donor->id]) }}" method="POST"
                onsubmit="return confirm('Are you sure you want to delete this menu item?')" style="display: inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-outline-secondary">
                    <i class="fa fa-trash" title="delete" style="font-size: 14px;" aria-hidden="true"></i>
                </button>
            </form>


        </td>
    </tr>
    @endforeach
</tbody>
<tfoot>
    <tr>
        <th>Sr</th>
        <th>Name</th>
        <th>Category</th>
        <th>Image(100x66)px</th>
        <th>Slug</th>
        <th>Commission</th>
        <th>Actions</th>
    </tr>
</tfoot>
@elseif (Route::currentRouteName() == 'coupon.index')
<thead>
    <th>Id</th>
    <th>Coupon Type</th>
    <th>Coupon Title</th>
    <th>Coupon Code</th>
    <th>Used Coupon</th>
    <th>Store</th>
    <!-- <th>Product</th> -->
    <th>Minimum Purchase</th>
    <th>Limit for Same User</th>
    <th>Amount</th>
    <th>Percentage</th>
    <th>Duration</th>
    <th>Status</th>
    <th>Actions</th>
</thead>
<tbody>

    @foreach ($coupons as $key => $item)
    <tr>
        <td>{{ $key + 1 }}</td>
        <td>

            @if ($item->coupon_type == 1)
            <p>Discount on Purchase</p>
            @elseif ($item->coupon_type == 2)
            <p>Free Delivery</p>
            @elseif ($item->coupon_type == 3)
            <p>First Order</p>
            @endif

        </td>
        <td>{{ $item->coupon_title ?: 'Nill' }}</td>
        <td>{{ $item->coupon_code ?: 'Nill' }}</td>
        <td>{{ $item->coupon_used == 1 ? 'used' : 'null' }}</td>
        <td>{{ $item->store ?: 'Nill' }}</td>
        <!-- <td>{{ $item->product_id ?: 'Nill' }}</td> -->
        <td>{{ $item->minimum_purchase ?: 'Nill' }}</td>
        <td>{{ $item->limit_same_user ?: 'Nill' }}</td>
        <td>{{ $item->amount ?: 'Nill' }}</td>
        <td>{{ $item->percentage ?: 'Nill' }}</td>
        <td>{{ $item->start_date }} : {{ $item->end_date }}</td>
        <td>
            <form id="toggle-form" method="POST" action="/toggle-coupon-status">
                @csrf
                <input type="hidden" name="coupon_id" value="{{ $item->id }}">
                <input type="hidden" name="status" value="{{ $item->status }}">
            </form>

            <label class="switch">
                <input type="checkbox" class="coupon-status-toggle" data-coupon-id="{{ $item->id }}"
                    {{ $item->status === 'active' ? 'checked' : '' }}>
                <span class="slider round"></span>
            </label>
        </td>
        <td>
            <form action="{{ route('coupon.destroy', ['coupon' => $item->id]) }}" method="POST"
                onsubmit="return confirm('Are you sure you want to delete this menu item?')" style="display: inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn rounded-pill btn-icon btn-outline-secondary">
                    <i class="fa fa-trash" title="delete" aria-hidden="true"></i>
                </button>
            </form>
        </td>

    </tr>
    @endforeach
</tbody>
<tfoot>
    <tr>
        <th>Sr No</th>
        <th>Coupon Type</th>
        <th>Coupon Title</th>
        <th>Coupon Code</th>
        <th>Used Coupon</th>
        <th>Store</th>
        <!-- <th>Product</th> -->
        <th>Minimum Purchase</th>
        <th>Limit for Same User</th>
        <th>Amount</th>
        <th>Percentage</th>
        <th>Duration</th>
        <th>Status</th>
        <th>Actions</th>
    </tr>
</tfoot>



{{-- All Purchases  --}}
@elseif (Route::currentRouteName() == 'purchase.index')
<thead>
    <th>Sr No</th>
    {{-- <th>Date</th> --}}
    <th>Purchase Id</th>
    {{-- <th>Bill Number</th> --}}
    <th>Product Name</th>
    <th>Model No</th>
    <th>SKU</th>
    <th>Quantity( In Stock )</th>
    <th>Action</th>
</thead>
<tbody>
    @foreach ($purchases as $key => $purchase)
    <tr>
        <td>{{ $key + 1 }}</td>
        {{-- <td>{{ $purchase->date}}</td> --}}
        <td>{{ $purchase->id }}</td>
        {{-- <td>{{ $purchase->bill_number}}</td> --}}
        <td>{{ $purchase->product->name ?? null }}</td>
        <td>{{ $purchase->product->model_no ?? null }}</td>
        <td>{{ $purchase->product->sku ?? null }}</td>
        <td>{{ $purchase->quantity }}</td>
        <td class="col-lg-1" style="white-space: nowrap;">
            <a href="{{ route('purchaseHistory') }}"><button type="button" class="btn btn-outline-secondary">
                    <i class="nav-icon i-Calendar" title="calender"></i>
                </button></a>
            {{-- <button type="button" class="btn btn-secondary">
                    <i class="nav-icon i-Eye" title="view"></i>
                </button> --}}
            <a href="{{ route('purchase.edit', ['purchase' => $purchase->id]) }}"
                class="btn rounded-pill btn-icon btn-secondary">
                <i class="fa fa-pencil-square-o" title="edit" aria-hidden="true"></i>
            </a>
            <form action="{{ route('purchase.destroy', ['purchase' => $purchase->id]) }}" method="POST"
                onsubmit="return confirm('Are you sure you want to delete this menu item?')" style="display: inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn rounded-pill btn-icon btn-outline-secondary">
                    <i class="fa fa-trash" title="delete" aria-hidden="true"></i>
                </button>
            </form>

        </td>

    </tr>
    @endforeach

</tbody>
<tfoot>
    <tr>
        <th>Sr No</th>
        {{-- <th>Date</th> --}}
        {{-- <th>Bill No#</th> --}}
        <th>Purchase Id</th>
        <th>Product Name</th>
        <th>Model No</th>
        <th>SKU</th>
        <th>Quantity( In Stock )</th>
        <th>Action</th>
    </tr>
</tfoot>
@elseif (Route::currentRouteName() == 'purchase.show')
<thead>
    <th>Sr No</th>
    <th>Date</th>
    <th>Purchase Id</th>
    <th>Bill No</th>
    {{-- <th>Added By</th> --}}
    <th>Product Name</th>
    <th>SKU</th>
    <th>Quantity(Stock)</th>
    <th>Cost</th>
    <th>Total</th>
    <th>Action</th>
</thead>
<tbody>
    {{-- {{$histories}} --}}
    @foreach ($histories as $key => $history)
    <tr>
        <td>{{ $key + 1 }}</td>
        <td>{{ $history->date }}</td>
        <td>{{ $history->purchase_id }}</td>
        <td>{{ $history->bill_number }}</td>
        {{-- <td>{{ $history->user->name}}</td> --}}
        <td>{{ $history->product->name ?? null }}</td>
        <td>{{ $history->product->sku ?? null }}</td>
        <td>{{ $history->quantity }}</td>
        <td>{{ $history->cost }}</td>
        <td>{{ $history->total }}</td>
        <td>
            {{-- <button type="button" class="btn btn-secondary">
                    <i class="nav-icon i-Eye" title="view"></i>
                </button> --}}
            <a href="{{ route('purchase.bill', ['purchaseId' => $history->bill_number]) }}"
                class="btn btn-outline-secondary">View Bill</a>
            <a href="{{ route('purchase.invoice', ['purchaseId' => $history->purchase_id]) }}"
                class="btn btn-outline-secondary">Total Puchase</a>

        </td>
    </tr>
    @endforeach

</tbody>
<tfoot>
    <tr>
        <th>Sr No</th>
        <th>Date</th>
        <th>Purchase Id</th>
        <th>Bill No</th>
        {{-- <th>Added By</th> --}}
        <th>Product Name</th>
        <th>SKU</th>
        <th>Quantity(Stock)</th>
        <th>Cost</th>
        <th>Total</th>
        <th>Action</th>
    </tr>
</tfoot>
@elseif (Route::currentRouteName() == 'supplier.index')
<thead>
    <th>Sr No</th>
    <th>Name</th>
    <th>Phone</th>
    <th>Email</th>
    <th>Website </th>
    <th>Address</th>
</thead>
<tbody>
    @foreach ($suppliers as $key => $supplier)
    <tr>
        <td>{{ $key + 1 }}</td>
        <td>{{ $supplier->name }}</td>
        <td>{{ $supplier->phone }}</td>
        <td>{{ $supplier->email }}</td>
        <td>{{ $supplier->website }}</td>
        <td>{{ $supplier->address }}</td>
    </tr>
    @endforeach

</tbody>
<tfoot>
    <tr>
        <th>Sr No</th>
        <th>Name</th>
        <th>Phone</th>
        <th>Email</th>
        <th>Website </th>
        <th>Address</th>
    </tr>
</tfoot>
@elseif (Route::currentRouteName() == 'addsubcat')
<table>
    <thead>
        <th>Sr No</th>
        <th>Category Id</th>
        <th>Name</th>
        <th>Image(100x66)px</th>
        <th>Slug</th>
    </thead>
    <tbody>
        @foreach ($data as $key => $subcat)
        <tr>
            <td>{{ $key + 1 }}</td>
            <td>{{ $subcat->category_id }}</td>
            <td>{{ $subcat->name }}</td>
            <td><img src="{{ asset($subcat->img) }}" width="50" height="50" loading="lazy"></td>
            <td>{{ $subcat->slug }}</td>
        </tr>
        @endforeach
    </tbody>
    @elseif (Route::currentRouteName() == 'allterm')
    <thead>
        <tr>
            <th>Id</th>
            <th>Title</th>
            <th>Description</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $item)
        <tr>
            <td>{{ $item['id'] }}</td>
            <td>{{ $item['title'] }}</td>
            {{-- <td>{{ $item["description"] }}</td> --}}
            <td>
                @if (Route::currentRouteName() == 'allterm')
                {{ Str::limit($item['description'], 90) }}
                @else
                {{ $item['description'] }}
                @endif
            </td>
            <td>
                <div class="d-flex gap-2">
                    <a target="_blank" href="{{ route('terms.edit', ['id' => $item->id]) }}"><button type="button"
                            class="btn btn-outline-secondary ">
                            <i class=" nav-icon i-Pen-2" title="edit" style="font-weight: bold;"></i>
                        </button></a>

                    <form action="{{ route('terms.destroy', ['id' => $item->id]) }}" method="POST"
                        onsubmit="return confirm('Are you sure you want to delete this term?')"
                        style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-secondary">
                            <i class="nav-icon i-Remove-Basket" title="remove"></i>
                        </button>
                    </form>

                    <a target="_blank" href="{{ route('terms.show', $item->id) }}">
                        <button type="button" class="btn btn btn-outline-secondary ">
                            <i class="nav-icon i-Eye" title="view" style="font-weight: bold;"></i>
                        </button></a>

                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <th>Id</th>
            <th>Title</th>
            <th>Description</th>
            <th>Action</th>
        </tr>
    </tfoot>
    @elseif (Route::currentRouteName() == 'pages.index')
    <thead>
        <tr>
            <th>Sr No</th>
            <th>Title</th>
            <th>Details</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $key => $value)
        <tr>
            <td>{{ $key + 1 }}</td>
            <td>
                @if (Route::currentRouteName() == 'pages.index')
                {{ Str::limit($value['question'], 40) }}
                @else
                {{ $value['question'] }}
                @endif
            </td>

            <td>
                @if (Route::currentRouteName() == 'pages.index')
                {{ Str::limit($value['answer'], 130) }}
                @else
                {{ $value['answer'] }}
                @endif
            </td>
            <td>
                <div class="d-flex gap-2">
                    <a target="_blank" href="{{ route('pages.edit', ['page' => $value->id]) }}"><button type="button"
                            class="btn btn-outline-secondary ">
                            <i class=" nav-icon i-Pen-2" title="edit" style="font-weight: bold;"></i>
                        </button></a>

                    <a href="{{ route('page.destroy', $value->id) }}">
                        <button type="button" class="btn btn-outline-secondary">
                            <i class="nav-icon i-Remove-Basket" title="remove"></i>
                        </button></a>
                </div>
            </td>
        </tr>
        @endforeach

    </tbody>
    <tfoot>
        <tr>
            <th>Sr No</th>
            <th>Question</th>
            <th>Answer</th>
            <th>Action</th>
        </tr>
    </tfoot>
    @elseif (Route::currentRouteName() == 'faqs_categories.index')
    <thead>
        <tr>
            <th>Sr No</th>
            <th>Category Name</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $key => $value)
        <tr>
            <td>{{ $key + 1 }}</td>
            <td>{{ $value->name }}
            </td>

            <td>
                <div class="d-flex gap-2">
                    <a target="_blank"
                        href="{{ route('faqs_categories.edit', ['faqs_category' => $value->id]) }}"><button
                            type="button" class="btn btn-outline-secondary ">
                            <i class=" nav-icon i-Pen-2" style="font-weight: bold;"></i>
                        </button></a>
                    <a href="{{ route('faqs_category.destroy', $value->id) }}">
                        <button type="button" class="btn btn-outline-secondary">
                            <i class="nav-icon i-Remove-Basket"></i>
                        </button></a>
                </div>
            </td>
        </tr>
        @endforeach

    </tbody>
    <tfoot>
        <tr>
            <th>Sr No</th>
            <th>Category Name</th>
            <th>Action</th>
        </tr>
    </tfoot>
    @elseif (Route::currentRouteName() == 'faqs.index')
    <thead>
        <tr>
            <th>Sr No</th>
            <th>Category</th>
            <th>Question</th>
            <th>Answer</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $key => $value)
        <tr>
            <td>{{ $key + 1 }}</td>
            <td>{{ $value->faq_category->name ?? null }}</td>
            <td>
                @if (Route::currentRouteName() == 'faqs.index')
                {{ Str::limit($value['question'], 40) }}
                @else
                {{ $value['question'] }}
                @endif
            </td>

            <td>
                @if (Route::currentRouteName() == 'faqs.index')
                {{ Str::limit($value['answer'], 90) }}
                @else
                {{ $value['answer'] }}
                @endif
            </td>
            <td>
                <div class="d-flex gap-2">
                    <a target="_blank" href="{{ route('faqs.edit', ['faq' => $value->id]) }}"><button type="button"
                            class="btn btn-outline-secondary ">
                            <i class=" nav-icon i-Pen-2" style="font-weight: bold;"></i>
                        </button></a>

                    <a href="{{ route('faq.destroy', $value->id) }}">
                        <button type="button" class="btn btn-outline-secondary">
                            <i class="nav-icon i-Remove-Basket"></i>
                        </button></a>
                </div>
            </td>
        </tr>
        @endforeach

    </tbody>
    <tfoot>
        <tr>
            <th>Sr No</th>
            <th>Category</th>
            <th>Question</th>
            <th>Answer</th>
            <th>Action</th>
        </tr>
    </tfoot>
    @elseif (Route::currentRouteName() == 'brands.index')
    <thead>
        <tr>
            <th>Sr No</th>
            <th>Name</th>
            <th>Image(190x70)px</th>
            <th>Logo</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $key => $value)
        <tr>
            <td>{{ $key + 1 }}</td>
            <td>{{ $value->brand_name }}</td>

            @if ($value->logo)
            <td><img src="{{ asset($value->logo) }}" width="50" height="50" loading="lazy"></td>
            @else
            <td>N/A</td>
            @endif

            @if ($value->logo)
            <td><img src="{{ asset($value->logo) }}" width="50" height="50"loading="lazy"></td>
            @else
            <td>N/A</td>
            @endif

            <td>
                <div class="d-flex gap-2">
                    <a target="_blank" href="{{ URL::to('brands/' . $value->id . '/edit') }}"><button type="button"
                            class="btn btn-outline-secondary ">
                            <i class=" nav-icon i-Pen-2" title="edit" style="font-weight: bold;"></i>
                        </button></a>

                    <a href="{{ asset('brands/' . $value->id . '/destroy') }}">
                        <button type="button" class="btn btn-outline-secondary">
                            <i class="nav-icon i-Remove-Basket" title="remove"></i>
                        </button></a>
                </div>
            </td>
        </tr>
        @endforeach

    </tbody>
    <tfoot>
        <tr>
            <th>Sr No</th>
            <th>Name</th>
            <th>Image</th>
            <th>Logo</th>
            <th>Action</th>
        </tr>
    </tfoot>
    @elseif (Route::currentRouteName() == 'payment_method.index')
    <thead>
        <tr>
            <th>Sr No</th>
            <th>Name</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $key => $value)
        <tr>
            <td>{{ $key + 1 }}</td>
            <td>{{ $value->name }}</td>



            <td>
                <div class="d-flex gap-2">
                    <a target="_blank" href="{{ URL::to('payment_method/' . $value->id . '/edit') }}"><button
                            type="button" class="btn btn-outline-secondary ">
                            <i class=" nav-icon i-Pen-2" style="font-weight: bold;"></i>
                        </button></a>

                    <a href="{{ asset('payment_method/' . $value->id . '/destroy') }}">
                        <button type="button" class="btn btn-outline-secondary">
                            <i class="nav-icon i-Remove-Basket"></i>
                        </button></a>
                </div>
            </td>
        </tr>
        @endforeach

    </tbody>
    <tfoot>
        <tr>
            <th>Sr No</th>
            <th>Name</th>
            <th>Action</th>
        </tr>
    </tfoot>
    @elseif (Route::currentRouteName() == 'banners.index')
    <thead>
        <tr>
            <th>Sr No</th>
            <th>Title1</th>
            <th>Title2</th>
            <th>Offer</th>
            <th>Image(190x70)px</th>
            <!-- <th>Bg Image</th> -->
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($banners as $key => $value)
        <tr>
            <td>{{ $key + 1 }}</td>
            <td>{{ $value->title1 }}</td>
            <td>{{ $value->title2 }}</td>
            <td>{{ $value->offer }}</td>
            <td><img src="{{ $value->image }}" width="50" height="50" alt="No" loading="lazy"></td>
            <!-- <td><img src="{{ $value->bg_image }}" width="50" height="50" alt="No"></td> -->
            <td>
                <div class="d-flex gap-2">
                    <a target="_blank" href="{{ URL::to('banners/' . $value->id . '/edit') }}"><button type="button"
                            class="btn btn-outline-secondary ">
                            <i class=" nav-icon i-Pen-2" title="edit" style="font-weight: bold;"></i>
                        </button></a>

                    <a href="{{ asset('banners/destroy/' . $value->id) }}">
                        <button type="button" class="btn btn-outline-secondary">
                            <i class="nav-icon i-Remove-Basket" title="remove"></i>
                        </button></a>
                </div>
            </td>
        </tr>
        @endforeach

    </tbody>
    <tfoot>
        <tr>
            <th>Sr No</th>
            <th>Title1</th>
            <th>Title2</th>
            <th>Offer</th>
            <th>Image/th>
                <!-- <th>Bg Image</th> -->
            <th>Action</th>
        </tr>
    </tfoot>


    {{-- ewallet scetion --}}
    @elseif (Route::currentRouteName() == 'collectedcash')
    <thead>
        <th>Sr No</th>
        <th>Customer Name</th>
        <th>Transcation Id</th>
        <th>Transcatio Type</th>
        <th>Amount</th>
    </thead>
    <tbody>
        <tr>
            <td>1</td>
            <td>Ali</td>
            <td>X2123bh8sdh</td>
            <td>Cash</td>
            <td>28</td>
        </tr>
    </tbody>
    <tfoot>
        <tr>
            <th>Sr No</th>
            <th>Customer Name</th>
            <th>Transcation Id</th>
            <th>Transcatio Type</th>
            <th>Amount</th>
        </tr>
    </tfoot>
    @elseif (Route::currentRouteName() == 'Totalbuying')
    <thead>
        <th>Sr No</th>
        <th>Date</th>
        <th>Product Name</th>
        <th>Model No</th>
        <th>SUpplier Info</th>
        <th>Total Amount</th>
    </thead>
    <tbody>
        <tr>
            <td>Sr No</td>
            <td>Date</td>
            <td>Product Name</td>
            <td>Model No</td>
            <td>SUpplier Info</td>
            <td>Total Amount</td>
        </tr>
    </tbody>
    <tfoot>
        <tr>
            <th>Sr No</th>
            <th>Date</th>
            <th>Product Name</th>
            <th>Model No</th>
            <th>SUpplier Info</th>
            <th>Total Amount</th>
    </tfoot>
    @elseif (Route::currentRouteName() == 'totalpendingwithdrawls')
    <thead>
        <th>Sr. No</th>
        <th>Withdrawal ID</th>
        <th>Date</th>
        <th>Card info</th>
        <th>Amount</th>
        <th>Status</th>
    </thead>
    <tbody>
        <tr>
            <td>Sr No</td>
            <td>Date</td>
            <td>Product Name</td>
            <td>Model No</td>
            <td>SUpplier Info</td>
            <td>Total Amount</td>
        </tr>
    </tbody>
    <tfoot>
        <tr>
            <th>Sr No</th>
            <th>Date</th>
            <th>Product Name</th>
            <th>Model No</th>
            <th>SUpplier Info</th>
            <th>Total Amount</th>
    </tfoot>
    @elseif (Route::currentRouteName() == 'totalrefund')
    <thead>
        <th>Sr. No</th>
        <th>Order ID</th>
        <th>Product Name + Pic</th>
        <th>Model No</th>
        <th>Customer Info</th>
        <th>Total Amount</th>
        <th>Refund Status</th>
    </thead>
    <tbody>
        <tr>
            <td>1</td>
            <td>54651</td>
            <td>Name goes here</td>
            <td>215645</td>
            <td>Customer Name</td>
            <td>Total Amount</td>
            <td>Refund Status</td>
        </tr>
    </tbody>
    <tfoot>
        <tr>
            <th>Sr. No</th>
            <th>Order ID</th>
            <th>Product Name + Pic</th>
            <th>Model No</th>
            <th>Customer Info</th>
            <th>Total Amount</th>
            <th>Refund Status</th>
    </tfoot>
    @elseif (Route::currentRouteName() == 'totalspendondeals')
    <thead>
        <th>Sr. No</th>
        <th>Date</th>
        <th>Transaction ID</th>
        <th>Coupon Type</th>
        <th>Coupon Code</th>
        <th>Amount</th>
    </thead>
    <tbody>
        <tr>
            <td>01</td>
            <td>27-07-2023</td>
            <td>5463423423451</td>
            <td>Eid Sale</td>
            <td>BIG-SALE-8656</td>
            <td>$1464</td>
        </tr>
    </tbody>
    <tfoot>
        <tr>
            <th>Sr. No</th>
            <th>Date</th>
            <th>Transaction ID</th>
            <th>Coupon Type</th>
            <th>Coupon Code</th>
            <th>Amount</th>
    </tfoot>
    @elseif (Route::currentRouteName() == 'totalwithdrawl')
    <thead>
        <th>Sr. No</th>
        <th>Withdrawl ID</th>
        <th>Date</th>
        <th>Card info</th>
        <th>Amount</th>
        <th>Status</th>
    </thead>
    <tbody>
        <tr>
            <td>01</td>
            <td>5463423423451</td>
            <td>27-07-2023</td>
            <td>********5467</td>
            <td>$12424</td>
            <td>Completed</td>
        </tr>
    </tbody>
    <tfoot>
        <th>Sr. No</th>
        <th>Withdrawl ID</th>
        <th>Date</th>
        <th>Card info</th>
        <th>Amount</th>
        <th>Status</th>
    </tfoot>
    @elseif (Route::currentRouteName() == 'transcationhistory')
    <thead>
        <th>Sr. No</th>
        <th>Date</th>
        <th>Withdrawl ID</th>
        <th>Transaction Type</th>
        <th>Amount</th>
    </thead>
    <tbody>
        <tr>
            <td>01</td>
            <td>27-07-2023</td>
            <td>5463423423451</td>
            <td>Order placed/Refund/Received/Commission</td>
            <td>$$142651</td>
        </tr>
    </tbody>
    <tfoot>
        <th>Sr. No</th>
        <th>Date</th>
        <th>Withdrawl ID</th>
        <th>Transaction Type</th>
        <th>Amount</th>
    </tfoot>
    @elseif (Route::currentRouteName() == 'Deals.index')
    <thead>
        <th>Sr No</th>
        <th>Id</th>
        <th>Name</th>
        <th>SKU</th>
        <th>Supplier</th>
        <th>Image(145x66)px</th>
        <th>Action</th>
    </thead>
    <tbody>
        @foreach ($data as $key => $product)
        <tr>
            <td>{{ $key + 1 }}</td>
            <td>{{ $product->id }}</td>
            <td>{{ $product->name }}</td>
            <td>{{ $product->sku }}</td>
            <td>{{ $product->make }}</td>
            @if ($product->url)
            <td><img src="{{ $product->url }}" width="50" height="50" loading="lazy"></td>
            @elseif($product->product_image)
            <td><img src="{{ $product->product_image->url ?? null }}" width="50" height="50" loading="lazy">
            </td>
            @else
            <td>image</td>
            @endif
            <td>
                <div class="d-flex gap-2">
                    <a target="_blank" href="{{ URL::to('Deals/' . $product->id . '/edit') }}"><button type="button"
                            class="btn btn-outline-secondary ">
                            <i {{-- class="fa fa-clone" --}} class=" nav-icon i-Pen-2" title="edit"
                                style="font-weight: bold;"></i>
                        </button></a>
                    <form action="{{ route('Deals.destroy', $product->id) }}" method="POST"
                        onsubmit="return confirm('Are you sure you want to delete this deal?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-secondary"> <i class="fa fa-trash" title="delete"
                                aria-hidden="true"></i></button>
                    </form>
                    <a href="https://www.industrymall.net/product-details/{{ $product->id }}" target="_blank"
                        class="btn btn-outline-secondary">
                        <i class="nav-icon i-Eye" title="view"></i>
                    </a>
                </div>

            </td>
        </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <th>Sr No</th>
            <th>Id</th>
            <th>Name</th>
            <th>SKU</th>
            <th>Supplier</th>
            <th>image(145x66)px</th>
            <th>Action</th>
        </tr>
    </tfoot>
    @elseif (Route::currentRouteName() == 'Homecoupons.index')
    <thead>
        <th>Id</th>
        <th>Coupon Type</th>
        <th>Coupon Title</th>
        <th>Coupon Code</th>
        <th>Used Coupon</th>
        <th>Store</th>
        <!-- <th>Product</th> -->
        <th>Minimum Purchase</th>
        <th>Limit for Same User</th>
        <th>Amount</th>
        <th>Percentage</th>
        <th>Duration</th>
        <!-- <th>Status</th> -->
        <th>Actions</th>
    </thead>
    <tbody>
        @foreach ($coupons as $key => $item)
        <tr>
            <td>{{ $item->id }}</td>
            <!-- <td>{{ $key + 1 }}</td> -->
            <td>
                @if ($item->coupon_type == 1)
                <p>Discount on Purchase</p>
                @elseif ($item->coupon_type == 2)
                <p>Free Delivery</p>
                @elseif ($item->coupon_type == 3)
                <p>First Order</p>
                @endif
            </td>
            <td>{{ $item->coupon_title ?: 'Nill' }}</td>
            <td>{{ $item->coupon_code ?: 'Nill' }}</td>
            <td>{{ $item->coupon_used == 1 ? 'used' : 'null' }}</td>
            <td>{{ $item->store ?: 'Nill' }}</td>
            <!-- <td>{{ $item->product_id ?: 'Nill' }}</td> -->
            <td>{{ $item->minimum_purchase ?: 'Nill' }}</td>
            <td>{{ $item->limit_same_user ?: 'Nill' }}</td>
            <td>{{ $item->amount ?: 'Nill' }}</td>
            <td>{{ $item->percentage ?: 'Nill' }}</td>
            <td>{{ $item->start_date }} : {{ $item->end_date }}</td>
            <!-- <td>
                    <form id="toggle-form" method="POST" action="/toggle-coupon-status">
                        @csrf
                        <input type="hidden" name="coupon_id" value="{{ $item->id }}">
                        <input type="hidden" name="status" value="{{ $item->status }}">
                    </form>
                    <label class="switch">
                        <input type="checkbox" class="coupon-status-toggle" data-coupon-id="{{ $item->id }}"
                            {{ $item->status === 'active' ? 'checked' : '' }}>
                        <span class="slider round"></span>
                    </label>
                </td> -->
            <td>
                <form action="{{ route('Homecoupons.destroy', $item->id) }}" method="POST"
                    onsubmit="return confirm('Are you sure you want to delete this deal?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-outline-secondary"> <i class="fa fa-trash" title="delete"
                            aria-hidden="true"></i></button>
                </form>
            </td>

        </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <th>Id</th>
            <th>Coupon Type</th>
            <th>Coupon Title</th>
            <th>Coupon Code</th>
            <th>Used Coupon</th>
            <th>Store</th>
            <!-- <th>Product</th> -->
            <th>Minimum Purchase</th>
            <th>Limit for Same User</th>
            <th>Amount</th>
            <th>Percentage</th>
            <th>Duration</th>
            <!-- <th>Status</th> -->
            <th>Actions</th>
        </tr>
    </tfoot>
    @elseif(Route::currentRouteName() == 'sellers.show')
    <div class="col-lg-6 md-6">
        <div class="account-card account-card-primary text-white rounded hover-card">
            @foreach ($bankDetail as $key => $value)
            <div class="row g-0">
                <div class="col-3 d-flex justify-content-center p-3">
                    <div class="my-auto text-center">
                        <span class="text-13" style="font-size: 70px;"><i class="fas fa-university"></i></span>
                        <p class="badge bg-warning text-dark text-0 fw-500 rounded-pill px-2 mb-0">Primary
                        </p>
                    </div>
                </div>
                <div class="col-9 border-start">
                    <div class="py-4 my-2 ps-4">
                        <p class="text-4 fw-500 mb-1">{{ $value->bank_name }}</p>
                        <p class="text-4 opacity-9 mb-1">{{ $value->account_no }}</p>
                        <p class="m-0">Approved <span class="text-3"><i class="fas fa-check-circle"></i></span></p>
                    </div>
                </div>
            </div>
            @endforeach
            <div class="account-card-overlay rounded">
                <a href="#" data-bs-target="#bank-account-details" data-bs-toggle="modal"
                    class="text-light btn-link mx-2" onclick="showBankAccountModal()">
                    <span class="me-1"><i class="fas fa-share"></i></span>More Details
                </a>
                <a href="#" class="text-light btn-link mx-2">
                    <span class="me-1"><i class="fas fa-minus-circle"></i></span>Delete
                </a>
            </div>
        </div>
        @else
        <p>No bank details available.</p>
    </div>
    @endif
    <script>
    $(function() {
        $("#example1").DataTable();
    });
    </script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    $(document).ready(function() {
        $('.coupon-status-toggle').change(function() {
            var isChecked = $(this).is(':checked');
            var statusInput = $('#toggle-form input[name="status"]');
            var couponId = $('#toggle-form input[name="coupon_id"]').val();

            if (isChecked) {
                statusInput.val('active');
            } else {
                statusInput.val('inactive');
            }

            $.ajax({
                type: 'POST',
                url: '/toggle-coupon-status',
                data: $('#toggle-form').serialize(), // Serialize the form data
                secondary: function(response) {
                    alert(response.message); // Show a secondary message
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText); // Handle errors
                }
            });
        });
    });
    </script>