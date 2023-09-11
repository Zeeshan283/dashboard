<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

@if (Route::currentRouteName() == 'allorders.index')
        <thead>
            <th>Sr No</th>
            <th>Order #</th>
            <th>Customer First Name</th>
            <th>Customer Last Name</th>
            <th>Order Date</th>
            <th>Shipping Date</th>
            <th>Status</th>
            <th>Action</th>
        </thead>
        <tbody>
        @foreach ($data as $value => $orders )
                                    <tr>
                                        <td>{{ $value + 1 }}</td>
                                        <td>{{ $orders->id }}</td>
                                        <td>{{ $orders->first_name }}</td>
                                        <td>{{ $orders->last_name }}</td>
                                        <td>{{ $orders->date }}</td>
                                        <td>{{ $orders->shipping }}</td>
                                        <td>{{ $orders->status}}</td>
                                        <td>

                                            <div class="d-flex gap-2">
                                            <button type="button" class="btn btn-danger ">
                                                <i class="nav-icon i-Close-Window  "></i>
                                            </button>
                                                {{-- </a><a href="{{ asset('orders/'.$orders->id) }}" class="btn btn-success btn-sm" target="_blank">Details</a> --}}
                                            <a href="{{ asset('allorders/'.$orders->id) }}" target="_blank"><button type="button" class="btn btn-success ">
                                                <i class="nav-icon  i-Pen-2"></i>
                                            </button></a>

                                            <button type="button" class="btn btn-primary">
                                                <i class="nav-icon i-Eye "></i>
                                            </button>
                                            </div>

                                        </td>
                                    </tr>
        @endforeach
        </tbody>
        <tfoot>
        <tr>
            <th>Sr No</th>
            <th>Order #</th>
            <th>Customer First Name</th>
            <th>Customer Last Name</th>
            <th>Order Date</th>
            <th>Shipping Date</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
        </tfoot>
@elseif (Route::currentRouteName() == 'pendingorders' )
    <thead>
        <th>Sr No</th>
        <th>Order #</th>
        <th>Customer Name</th>
        <th>Order Date & Time</th>
        <th>Shipping Date</th>
        <th>Status</th>
        <th>Action</th>
    </thead>
    <tbody>

    @foreach ($data as $value =>$order )
        <tr>
            <td>{{$value + 1}}</td>
            <td>{{$order->id}}</td>
            <td>{{$order->first_name}}</td>
            <td>{{$order->created_at}}</td>
            <td>{{$order->shipping}}</td>
            <td>{{$order->status}}</td>
            <td>

                <div class="d-flex gap-2">
                <button type="button" class="btn btn-success ">
                    <i class="nav-icon i-Pen-2 "></i>
                </button>
                    <button type="button" class="btn btn-danger ">
                    <i class="nav-icon i-Close-Window "></i>
                </button>
                <button type="button" class="btn btn-primary">
                    <i class="nav-icon i-Eye "></i>
                </button>
                </div>

            </td>
        </tr>
    @endforeach
    </tbody>
    <tfoot>
    <tr>
        <th>Sr No</th>
        <th>Order #</th>
        <th>Customer Name</th>
        <th>Order Date</th>
        <th>Shipping Date</th>
        <th>Status</th>
        <th>Action</th>
    </tr>
    </tfoot>

@elseif (Route::currentRouteName() == 'confirmedorders' )
    <thead>
        <th>Sr No</th>
        <th>Order #</th>
        <th>Customer Name</th>
        <th>Order Date</th>
        <th>Shipping Date</th>
        <th>Status</th>
        <th>View Invoice</th>

        <th>Reviews</th>
        <th>Actions</th>
    </thead>
    <tbody>

        @foreach ($data as $value =>$order )
        <tr>
            <td>{{$value + 1}}</td>
            <td>{{$order->id}}</td>
            <td>{{$order->first_name}}</td>
            <td>{{$order->created_at}}</td>
            <td>{{$order->shipping}}</td>
            <td>{{$order->status}}</td>
            <td>
                <div class="d-flex ">
                <button type="button" class="btn btn-info" style="width: 80px">
                    {{-- <i class="nav-icon i-Eye " style="width: 100px"></i> --}}
                    <span>invoice</span>
                </button>
                </div>
            </td>
            <td>
                <div class="d-flex gap-2">
                    <span>*****</span>

            </td>
            <td>
                <div class="d-flex gap-2">
                    <button type="button" class="btn btn-success ">
                        <i class="nav-icon i-Pen-2 "></i>
                    </button>
                        <button type="button" class="btn btn-danger ">
                        <i class="nav-icon i-Close-Window "></i>
                    </button>
                </div>
            </td>
        </tr>
    @endforeach
    </tbody>
    <tfoot>
    <tr>
        <th>Sr No</th>
        <th>Order #</th>
        <th>Customer Name</th>
        <th>Order Date</th>
        <th>Shipping Date</th>
        <th>Status</th>
        <th>View Invoice</th>
        <th>Reviews</th>
        <th>Actions</th>
    </tr>
    </tfoot>

@elseif (Route::currentRouteName() == 'packagingorders' )
    <thead>
        <th>Sr No</th>
        <th>Order #</th>
        <th>Customer Name</th>
        <th>Order Date</th>
        <th>Shipping Date</th>
        <th>Status</th>
        <th>Reviews</th>
        <th>View Invoice</th>
        <th>Actions</th>
    </thead>
    <tbody>
        @foreach ($data as $value =>$order )
        <tr>
            <td>{{$value + 1}}</td>
            <td>{{$order->id}}</td>
            <td>{{$order->first_name}}</td>
            <td>{{$order->created_at}}</td>
            <td>{{$order->shipping}}</td>
            <td>{{$order->status}}</td>
            <td>
                <div class="d-flex gap-2">
                    <span>*****</span>

            </td>
            <td>
                <div class="d-flex ">
                <button type="button" class="btn btn-info" style="width: 80px">
                    {{-- <i class="nav-icon i-Eye " style="width: 100px"></i> --}}
                    <span>invoice</span>
                </button>
                </div>
            </td>
            <td>
                <div class="d-flex gap-2">
                    <button type="button" class="btn btn-success ">
                        <i class="nav-icon i-Pen-2 "></i>
                    </button>
                        <button type="button" class="btn btn-danger ">
                        <i class="nav-icon i-Close-Window "></i>
                    </button>
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
    <tfoot>
    <tr>
        <th>Sr No</th>
        <th>Order #</th>
        <th>Customer Name</th>
        <th>Order Date</th>
        <th>Shipping Date</th>
        <th>Status</th>
        <th>Reviews</th>
        <th>View Invoice</th>
        <th>Actions</th>
    </tr>
    </tfoot>

@elseif (Route::currentRouteName() == 'outofdelivery' )
    <thead>
        <th>Sr No</th>
        <th>Order #</th>
        <th>Customer Name</th>
        <th>Order Date</th>
        <th>Shipping Date</th>
        <th>Vendor</th>
        <th>Status</th>
    </thead>
    <tbody>
        @foreach ($data as $value =>$order )
        <tr>
            <td>{{$value + 1}}</td>
            <td>{{$order->id}}</td>
            <td>{{$order->first_name}}</td>
            <td>{{$order->created_at}}</td>
            <td>{{$order->shipping}}</td>
            <td>{{$order->company}}</td>
            <td>{{$order->status}}</td>
        </tr>
        @endforeach
    </tbody>
    <tfoot>
    <tr>
        <th>Sr No</th>
        <th>Order #</th>
        <th>Customer Name</th>
        <th>Order Date</th>
        <th>Shipping Date</th>
        <th>Vendor</th>
        <th>Status</th>
    </tr>
    </tfoot>
@elseif (Route::currentRouteName() == 'delivered' )
    <thead>
        <th>Sr No</th>
        <th>Order #</th>
        <th>Customer Name</th>
        <th>Order Date</th>
        <th>Shipping Date</th>
        <th>Vendor</th>
        <th>Status</th>
    </thead>
    <tbody>
        @foreach ($data as $value =>$order )
        <tr>
            <td>{{$value + 1}}</td>
            <td>{{$order->id}}</td>
            <td>{{$order->first_name}}</td>
            <td>{{$order->created_at}}</td>
            <td>{{$order->shipping}}</td>
            <td>{{$order->company}}</td>
            <td>{{$order->status}}</td>
        </tr>
        @endforeach
    </tbody>
    <tfoot>
    <tr>
        <th>Sr No</th>
        <th>Order #</th>
        <th>Customer Name</th>
        <th>Order Date</th>
        <th>Shipping Date</th>
        <th>Vendor</th>
        <th>Status</th>
    </tr>
    </tfoot>
@elseif (Route::currentRouteName() == 'returned' )
    <thead>
        <th>Sr No</th>
        <th>Order #</th>
        <th>Customer Name</th>
        <th>Order Date</th>
        <th>Shipping Date</th>
        <th>Vendor</th>
        <th>Status</th>
    </thead>
    <tbody>
        @foreach ($data as $value =>$order )
        <tr>
            <td>{{$value + 1}}</td>
            <td>{{$order->id}}</td>
            <td>{{$order->first_name}}</td>
            <td>{{$order->created_at}}</td>
            <td>{{$order->shipping}}</td>
            <td>{{$order->company}}</td>
            <td>{{$order->status}}</td>
        </tr>
        @endforeach
    </tbody>
    <tfoot>
    <tr>
        <th>Sr No</th>
        <th>Order #</th>
        <th>Customer Name</th>
        <th>Order Date</th>
        <th>Shipping Date</th>
        <th>Vendor</th>
        <th>Status</th>
    </tr>
    </tfoot>
@elseif (Route::currentRouteName() == 'ftod' )
    <thead>
        <th>Sr No</th>
        <th>Order #</th>
        <th>Customer Name</th>
        <th>Order Date</th>
        <th>Shipping Date</th>
        <th>Vendor</th>
        <th>Status</th>
    </thead>
    <tbody>
        @foreach ($data as $value =>$order )
        <tr>
            <td>{{$value + 1}}</td>
            <td>{{$order->id}}</td>
            <td>{{$order->first_name}}</td>
            <td>{{$order->created_at}}</td>
            <td>{{$order->shipping}}</td>
            <td>{{$order->company}}</td>
            <td>{{$order->status}}</td>
        </tr>
        @endforeach
    </tbody>
    <tfoot>
    <tr>
        <th>Sr No</th>
        <th>Order #</th>
        <th>Customer Name</th>
        <th>Order Date</th>
        <th>Shipping Date</th>
        <th>Vendor</th>
        <th>Status</th>
    </tr>
    </tfoot>
@elseif (Route::currentRouteName() == 'canceled' )
    <thead>
        <th>Sr No</th>
        <th>Order #</th>
        <th>Customer Name</th>
        <th>Order Date</th>
        <th>Shipping Date</th>
        <th>Vendor</th>
        <th>Status</th>

    </thead>
    <tbody>
        @foreach ($data as $value =>$order )
        <tr>
            <td>{{$value + 1}}</td>
            <td>{{$order->id}}</td>
            <td>{{$order->first_name}}</td>
            <td>{{$order->created_at}}</td>
            <td>{{$order->shipping}}</td>
            <td>{{$order->company}}</td>
            <td>{{$order->status}}</td>
        </tr>
        @endforeach
    </tbody>
    <tfoot>
    <tr>
        <th>Sr No</th>
        <th>Order #</th>
        <th>Customer Name</th>
        <th>Order Date</th>
        <th>Shipping Date</th>
        <th>Vendor</th>
        <th>Status</th>
    </tr>
    </tfoot>

{{-- vendor list  --}}

@elseif (Route::currentRouteName() == '1234' )
    <thead>
        <th>Sr No</th>
        <th>Name wsd</th>
        <th>Phone Number</th>
        <th>Email</th>
        <th>Status</th>
        <th>Action</th>
    </thead>
    <tbody>
        {{-- @foreach($data as $data)
        <tr>
            <td>{{$data->id}}</td>
            <td>{{$data->name}}</td>
            <td>{{$data->phone1}}</td>
            <td>{{$data->email}}</td>
            <td>{{$data->status}}</td>
            <td><a href="{{url('/admin/edit-service/' . $data['id'])}}" class="btn rounded-pill btn-icon btn-primary"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></td>
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

@elseif (Route::currentRouteName() == 'vendor.index' )
    <thead>
        <th>Sr No</th>
        <th>Name</th>
        <th>Phone Number</th>
        <th>Email</th>
        <th>Status</th>
        <th>Action</th>
    </thead>
    <tbody>
       
        @foreach ($vendor as $value =>  $vendors )
        <tr>
            {{-- {{-- <td>{{$value + 1}}</td> --}}
            <td>{{ $vendors->id}}</td>
            <td>{{ $vendors->name}}</td>
            <td>{{ $vendors->phone1}}</td>
            <td>{{ $vendors->email}}</td>
            {{-- <td>{{ $vendors->status}}</td> --}}
            <td>
                @if ( $vendors->status == '0')
                    <span class="badge text-bg-success">Active</span>
                @elseif ($vendors->status == '1')
                    <span class="badge text-bg-success">In_Active</span>
                @endif
            </td>
            <td>
                <div class="d-flex gap-2">
                    <a href="{{ url('editseller/'.$vendors->id) }}" class="btn btn-success"><i class="nav-icon i-Pen-2 "></i>Edit</a>
                    
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
        <th>Status</th>
        <th>Action</th>
    </tr>
    </tfoot>


    {{-- vendor withdrawl list  --}}
@elseif (Route::currentRouteName() == 'withdrawl' )
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
@elseif (Route::currentRouteName() == 'allrefunds' )
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
        <td>{{ $value->Vendor}}</td>
        <td>{{ $value->product->sku }}</td>
        <td>{{ $value->customer_id}}</td>
        <td>{{ $value->order_id}}</td>
        <td>{{ $value->reason}}</td>
        <td>{{ $value->amount}}</td>
        <form   method ="POST" action="{{ route('refund.update')}}" >
        @csrf
        <td>
                <select class="form-control" id="product_id">
                    <option value="" selected disabled>Select Status</option>
                    {{-- @foreach ($products as $product) --}}
                        <option name="status[]" value="Pending">Pending</option>
                        <option  name="status[]"  value="Aproved">Approved</option>
                        <option   name="status[]" value="Refunded">Refunded</option>
                        <option   name="status[]" value="Rejected">Rejected</option>
                    {{-- @endforeach --}}
                </select>
        </td>
        <td>
            <button type ="submit" class="btn btn-primary ladda-button example-button m-1" data-style="expand-left"><span class="ladda-label">Update</span></button>
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

@elseif (Route::currentRouteName() == 'pendingrefund' )
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

@elseif (Route::currentRouteName() == 'approvedrefund' )
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
        <td><span class="i-Eye-Visible"></span></td>
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

@elseif (Route::currentRouteName() == 'refunded' )
    <thead>
        <th>Sr No</th>
        <th>Refund Id#</th>
        <th>Customer Name</th>
        <th>Product</th>
        <th>Amount</th>
        <th>Reason</th>
    </thead>
    <tbody>
    @foreach ($refunds as $key => $refund )

    @endforeach
    <tr>
        <td>{{ $key + 1 }}</td>
        <td>{{ $refund->id}}</td>
        <td>{{ $refund->customer->name }}</td>
        <td>{{ $refund->product->sku }}</td>
        <td>{{ $refund->amount}}</td>
        <td>{{ $refund->reason}}</td>

        <td><span class="i-Eye-Visible"></span></td>    </tr>
    </tbody>
    <tfoot>
    <tr>
        <th>Sr No</th>
        <th>Refund Id#</th>
        <th>Customer Name</th>
        <th>Product</th>
        <th>Amount</th>
        <th>Reason</th>
    </tr>
    </tfoot>

@elseif (Route::currentRouteName() == 'refundrejected' )
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
        <td><span class="i-Eye-Visible"></span></td>
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

@elseif (Route::currentRouteName() == 'refundrejected' )
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
        <td><span class="i-Eye-Visible"></span></td>
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
@elseif (Route::currentRouteName() == 'refundrejected' )
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
        <td><span class="i-Eye-Visible"></span></td>
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

{{-- customer related tables  --}}
@elseif (Route::currentRouteName() == 'customerlist' )
    <thead>
        <th>Sr No</th>
        <th>First Name</th>
        <th>Last Name Name</th>
        <th>Phone Number</th>
        <th>Email</th>
    </thead>
    <tbody>
        @foreach ($customer as $value => $customers )
        <tr>
            {{-- <td>{{$value + 1}}</td> --}}
            <td>{{$customers->id}}</td>
            <td>{{$customers->first_name}}</td>
            <td>{{$customers->last_name}}</td>
            <td>{{$customers->phone1}}</td>
            <td>{{$customers->email}}</td>
        </tr>
        @endforeach
    </tbody>
    <tfoot>
    <tr>
        <th>Sr No</th>
        <th>Name</th>
        <th>Phone Number</th>
        <th>Email</th>
    </tr>
    </tfoot>
@elseif (Route::currentRouteName() == 'users.index' )
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
        @foreach($users as $user)
            <tr>
                <td>{{$user->id}}</td>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td>{{$user->phone}}</td>
                <td>{{$user->country}}</td>
                <td>{{$user->city}}</td>
                <td>{{$user->addres}}</td>
                <td>{{$user->gender}}</td>
                <td><a href="{{ route('user.edit', ['id' => $user->id]) }}" class="btn rounded-pill btn-icon btn-primary">
                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                </a></td>
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


    {{-- product info  --}}
@elseif (Route::currentRouteName() == 'products.index' )
    <thead>
        <th>Sr No</th>
        <th>Name</th>
        <th>Model#</th>
        <th>SKU</th>
        <th>Category</th>
        <th>Supplier</th>
        <th>Image</th>
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
                                                {{ $product->categories->name }}
                                            @endif
                                            ,
                                            @if ($product->subcategories)
                                                {{ $product->subcategories->name }}
                                            @endif
                                        </td>
                                        <td>{{$product->make}}</td>

                                        @if($product->url)
                                        <td><img src="{{ $product->url }}" width="50" height="50"></td>
                                        @elseif($product->product_image)
                                        <td><img src="{{ $product->product_image->url}}" width="50" height="50"></td>

                                        @else
                                        <td>image</td>
                                        @endif

                                        {{-- <td>
                                            @if ($product->type == 'Parent')
                                                <span class="badge text-bg-success">{{ $product->type }}</span>
                                            @elseif ($product->type == 'Child')
                                                <span class="badge text-bg-success">{{ $product->type }}</span>
                                            @endif
                                        </td> --}}
                                        <td>

                                            <div class="d-flex gap-2">
                                            <a  target="_blank" href="{{ URL::to('products/' . $product->id . '/edit') }}"><button type="button"  class="btn btn btn-outline-secondary ">
                                                <i
                                                {{-- class="fa fa-clone" --}}
                                                 class=" nav-icon i-Pen-2"
                                                style="font-weight: bold;"></i>
                                            </button></a>
                                                <a  target="_blank" href="{{ URL::to('product/' . $product->id . '/dupe')}}"><button type="button"  class="btn btn-outline-secondary ">
                                                <i class="fa fa-clone"
                                                {{-- class="nav-icon i-Duplicate-Window" --}}
                                                 style="font-weight: bold;"></i>
                                            </button></a>
                                            {{-- <a href="">
                                            <button type="button" class="btn btn-outline-secondary ">
                                                <i class="fa fa-eye"
                                                class="nav-icon i-Eye"
                                                ></i>
                                            </button></a> --}}

                                            {{-- <a href="{{URL::to('product/'. $product->id. '/delete')}}">
                                            <button type="button" class="btn btn-danger">
                                                <i class="nav-icon i-Remove-Basket"></i>
                                            </button>
                                            </a> --}}
                                            </div>

                                        </td>
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
        <th>image</th>
        {{-- <th>Type</th> --}}
        <th>Action</th>
    </tr>
    </tfoot>

@elseif (Route::currentRouteName() == 'productreviews' )
    <thead>
        <th>Sr No</th>
        <th>Customer Name</th>
        <th>Model#</th>
        <th>SKU</th>
        <th>Rating</th>
        <th>Comments</th>
    </thead>
    <tbody>
    <tr>
        <td>1</td>
        <td>Tiger Nixon</td>
        <td>System Architect</td>
        <td>Edinburgh</td>
        <td>61</td>
        <td>2011/04/25</td>
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
    </tr>
    </tfoot>
@elseif (Route::currentRouteName() == 'creviews' )
    <thead>
        <th>Sr No</th>
        <th>Product Id#</th>
        <th>Customer Name</th>
        <th>Customer Email</th>
        <th>Reviews</th>
        <th>Rating</th>
    </thead>
    <tbody>
    @foreach ($Reviews as $key => $review)
            <tr>
                <td>{{ $key+1 }}</td>
                <td>{{ $review->product_id}}</td>
                <td>{{ $review->customer_name}}</td>
                <td>{{ $review->customer_email}}</td>
                <td>{{ $review->review}}</td>

                <td>
                    @php
                        $rating = $review->rating;
                    @endphp

                    <div class="rating d-flex flex-direction-right">
                        @for ($i = 1; $i <= 5; $i++)
                            {{-- <i class="nav-icon i-David-Star" style="color: {{ $i <= $rating ? '#f5c60b' : '#ccc' }}; font-size: 10px; margin-right: 5px;"></i> --}}
                            <i class="nav-icon star-icon" style="color: {{ $i <= $rating ? '#f5c60b' : '#ccc' }}; font-size: 25px;"></i>
                        @endfor
                    </div>
                </td>
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

@elseif (Route::currentRouteName() == 'allmenu' )
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
            <td><i class="{{ $menu->icon }}" style='color:#5233ff; font-size: 30px; margin-right: 10px;'></i></td>
            <td class="col-lg-1" style="white-space: nowrap;">
                <a href="{{ route('menu.edit', ['id' => $menu->id]) }}" class="btn rounded-pill btn-icon btn-primary">
                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                </a>
                <form action="{{ route('menu.destroy', ['id' => $menu->id]) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this menu item?')" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn rounded-pill btn-icon btn-danger">
                        <i class="fa fa-trash" aria-hidden="true"></i>
                    </button>
                </form>
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
    @elseif (Route::currentRouteName() == 'addmenu' )
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
            <td><i class="{{ $menu->icon }}" style='color:#5233ff;  font-size: 30px;margin-right: 10px;'></i></td>
            {{-- <td><i class="{{ $menu->icon }}"></i></td> --}}
        @endforeach
    </tbody>
@elseif (Route::currentRouteName() == 'allcat' )
    <thead>
        <th>Sr No</th>
        <th>Id#</th>
        <th>Name</th>
        <th>Menu</th>
        <th>Commission</th>
        <th>Image</th>
        <th>Action</th>
    </thead>
    <tbody>
        @foreach ($data as $key => $cate)
        <tr>
            <td>{{ $key + 1 }}</td>
            <td>{{ $allcat->id }}</td>
            <td>{{ $allcat->name }}</td>
            <td>{{ $allcat->menu }}</td>
            <td>{{ $allcat->commision }}</td>
            <td><img src="<?php echo $allcat['img']; ?>" width="50" height="50"></td>
            <td class="col-lg-1" style="white-space: nowrap;">
                <a href="{{ route('category.editcat', ['id' => $allcat->id]) }}" class="btn rounded-pill btn-icon btn-primary">
                   <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
               </a>
               <form action="{{ route('category.destroy', ['id' => $allcat->id]) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this category item?')" style="display: inline;">
                   @csrf
                   @method('DELETE')
                   <button type="submit" class="btn rounded-pill btn-icon btn-danger">
                       <i class="fa fa-trash" aria-hidden="true"></i>
                   </button>
               </form>
           </td>
        </tr>
        @endforeach
    </tbody>
    {{-- <tfoot>
    <tr>
        <th>Sr No</th>
        <th>Id#</th>
        <th>Name</th>
        <th>Image</th>
        <th>Actions</th>

    </tr>
    </tfoot> --}}

@elseif (Route::currentRouteName() == 'allsubcat' )
<thead>
    <tr>    
        <th>Sr</th>
        <th>Name</th>
        <th>Category</th>
        <th>Image</th>
        <th>Slug</th>
        <th>Action</th>

    </thead>
    <tbody>
        @foreach ($data as $key => $allsubcat)
        <tr>
            <td>{{ $key + 1 }}</td>
            <td>{{ $allsubcat->category_id }}</td>
            <td>{{ $allsubcat->name }}</td>
            <td><img src="<?php echo $allsubcat['image']; ?>" width="50" height="50"></td>
            <td>{{ $allsubcat->slug }}</td>
            {{-- <td class="col-lg-1" style="white-space: nowrap;">
                 <a href="{{ route('subcategory.edit', ['id' => $subcategory->id]) }}" class="btn rounded-pill btn-icon btn-primary">
                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                </a>
                <form action="{{ route('subcategory.destroy', ['id' => $subcategory->id]) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this menu item?')" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn rounded-pill btn-icon btn-danger">
                        <i class="fa fa-trash" aria-hidden="true"></i>
                    </button>
                </form>
            </td> --}}
        </tr>
        @endforeach
    </tbody>
    {{-- <tfoot>
    <tr>
        <th>Sr No</th>
        <th>Id#</th>
        <th>Name</th>
        <th>Image</th>
        <th>Slug</th>
        <th>Actions</th>
    </tr>

    </tfoot>
@elseif (Route::currentRouteName() == 'coupon.index' )
<thead>
    <th>Sr No</th>
    <th>Coupon Type</th>
    <th>Coupon Title</th>
    <th>Coupon Code</th>
    <th>Store</th>
    <th>Product</th>
    <th>Minimum Purchase</th>
    <th>Limit for Same User</th>
    <th>Amount</th>
    <th>Percentage</th>
    <th>Duration</th>
    <th>Action</th>
</thead>
<tbody>
@foreach ($coupons as $key => $item)

    <tr>
        <td>{{ $key + 1 }}</td>
        <td>

            @if( $item->coupon_type == 1)
                <p>Discount on Purchase</p>
            @elseif ($item->coupon_type == 2)
                <p>Free Delivery</p>
            @elseif ($item->coupon_type == 3)
                <p>First Order</p>
            @endif

        </td>
        <td>{{ $item->coupon_title ?: 'Nill'}}</td>
        <td>{{ $item->coupon_code ?: 'Nill'}}</td>
        <td>{{ $item->store ?: 'Nill'}}</td>
        <td>{{ $item->product_id ?: 'Nill'}}</td>
        <td>{{ $item->minimum_purchase ?: 'Nill'}}</td>
        <td>{{ $item->limit_same_user ?: 'Nill'}}</td>
        <td>{{ $item->amount ?: 'Nill'}}</td>
        <td>{{ $item->percentage ?: 'Nill'}}</td>
        <td>{{ $item->start_date}} : {{ $item->end_date}}</td>\

        <td>
            <label class="switch">
                <input type="checkbox" class="coupon-status-toggle" data-coupon-id="{{ $item->id }}" {{ $item->stauts ? 'checked' : '' }}>
                <span class="slider round"></span>
            </label>
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
    <th>Store</th>
    <th>Product</th>
    <th>Minimum Purchase</th>
    <th>Limit for Same User</th>
    <th>Amount</th>
    <th>Percentage</th>
    <th>Duration</th>
    <th>Action</th>
</tr>
</tfoot>



{{-- All Purchases  --}}

@elseif (Route::currentRouteName() == 'purchase.index' )
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
            <td>{{ $purchase->id}}</td>
            {{-- <td>{{ $purchase->bill_number}}</td> --}}
            <td>{{ $purchase->product->name}}</td>
            <td>{{ $purchase->product->model_no}}</td>
            <td>{{ $purchase->product->sku}}</td>
            <td>{{ $purchase->quantity}}</td>
            <td class="col-lg-1" style="white-space: nowrap;">
                <a href="{{ route('purchaseHistory')}}"><button type="button" class="btn btn-info">
                    <i class="nav-icon i-Calendar "></i>
                </button></a>
                <button type="button" class="btn btn-info">
                    <i class="nav-icon i-Eye "></i>
                </button>
                <a href="{{ route('purchase.edit', ['purchase' => $purchase->id]) }}" class="btn rounded-pill btn-icon btn-primary">
                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                </a>
                <form action="{{ route('purchase.destroy', ['purchase' => $purchase->id]) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this menu item?')" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn rounded-pill btn-icon btn-danger">
                        <i class="fa fa-trash" aria-hidden="true"></i>
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


@elseif (Route::currentRouteName() == 'purchase.show' )
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
            <td>{{ $history->date}}</td>
            <td>{{ $history->purchase_id}}</td>
            <td>{{ $history->bill_number}}</td>
            {{-- <td>{{ $history->user->name}}</td> --}}
            <td>{{ $history->product->name}}</td>
            <td>{{ $history->product->sku}}</td>
            <td>{{ $history->quantity}}</td>
            <td>{{ $history->cost}}</td>
            <td>{{ $history->total}}</td>
            <td>
                <button type="button" class="btn btn-info">
                    <i class="nav-icon i-Eye "></i>
                </button>
                {{-- <a href="{{ route('history.edit', ['history' => $purchase->id]) }}" class="btn rounded-pill btn-icon btn-primary">
                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                </a> --}}
                <a href="{{ route('purchase.bill', ['purchaseId' => $history->bill_number]) }}" class="btn btn-danger">View Bill</a>
                <a href="{{ route('purchase.invoice', ['purchaseId' => $history->purchase_id]) }}" class="btn btn-primary">Total Puchase</a>

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


@elseif (Route::currentRouteName() == 'supplier.index' )
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
            <td>{{ $supplier->name}}</td>
            <td>{{ $supplier->phone}}</td>
            <td>{{ $supplier->email}}</td>
            <td>{{ $supplier->website}}</td>
            <td>{{ $supplier->address}}</td>
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






@elseif (Route::currentRouteName() == 'addsubcat' )
    <table>
        <thead>
            <th>Sr No</th>
            <th>Category Id</th>
            <th>Name</th>
            <th>Image</th>
            <th>Slug</th>
        </thead>
        <tbody>
            @foreach ($data as $key => $subcat)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $subcat->category_id }}</td>
                    <td>{{ $subcat->name }}</td>
                    <td><img src="{{ asset($subcat->img) }}" width="50" height="50"></td>
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
            @foreach($data as $item)
                <tr>
                    <td>{{ $item["id"] }}</td>
                    <td>{{ $item["title"] }}</td>
                    {{-- <td>{{ $item["description"] }}</td> --}}
                    <td>
                        @if(Route::currentRouteName() == 'allterm')
                        {{ Str::limit($item["description"], 90) }}
                        @else
                            {{ $item["description"] }}
                        @endif
                    </td>
                    <td class="col-lg-1" style="white-space: nowrap;">
                        <a href="{{ route('terms.edit', ['id' => $item->id]) }}" class="btn rounded-pill btn-icon btn-primary">
                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                        </a>
                        <form action="{{ route('terms.destroy', ['id' => $item->id]) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this term?')" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn rounded-pill btn-icon btn-danger">
                                <i class="fa fa-trash" aria-hidden="true"></i>
                            </button>
                        </form>
                        <a href="{{ route('terms.show', $item->id) }}" class="btn btn-sm btn-primary"><i class="fas fa-eye"></i></a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    @elseif (Route::currentRouteName() == 'addterm')
        <thead>
            <tr>
                <th>Id</th>
                <th>Title</th>
                <th>Description</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $item)
                <tr>
                    <td>{{ $item["id"] }}</td>
                    <td>{{ $item["title"] }}</td>
                    <td>{{ $item["description"] }}</td>
                    {{-- <td>{{ date('d-m-Y', strtotime($item["created_at"])) }}</td> --}}
                </tr>
            @endforeach
        </tbody>
    @endif

<script>
        $(function() {
            $("#example1").DataTable();
        });
</script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('.coupon-status-toggle').on('change', function() {
            const couponId = $(this).data('coupon-id');
            const isActive = this.checked ? 1 : 0; // 1 for active, 0 for inactive

            // Send an AJAX request to update the coupon status
            $.ajax({
                type: 'POST',
                url: '/update-coupon-status', // Replace with your update route
                data: {
                    coupon_id: couponId,
                    is_active: isActive,
                },
                success: function(response) {
                    // Handle success (e.g., show a message)
                    console.log('Coupon status updated successfully.');
                },
                error: function(error) {
                    // Handle error (e.g., show an error message)
                    console.error('Error updating coupon status.');
                },
            });
        });
    });
</script>
