<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

@if (Route::currentRouteName() == 'allorders')
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

@elseif (Route::currentRouteName() == 'vendorlist' )
    <thead>
        <th>Sr No</th>
        <th>Name</th>
        <th>Phone Number</th>
        <th>Email</th>
        <th>Status</th>
        <th>Action</th>
    </thead>
    <tbody>
        {{-- <tr>
            <td>Tiger Nixon</td>
            <td>System Architect</td>
            <td>Edinburgh</td>
            <td>61</td>
            <td>2011/04/25</td>
            <td>$320,800</td>
        </tr> --}}
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
                    {{-- <a href="{{ url('deleteseller/'.$vendors->id) }}" class="btn btn-danger"><i class="nav-icon i-Close-Window "></i>Delete</a> --}}
                    {{-- <button type="button" value="{{ $vendors->id }}" class="btn btn-success "><i class="nav-icon i-Pen-2 "></i></button> --}}
                    {{-- <button type="button" class="btn btn-danger "><i class="nav-icon i-Close-Window "></i></button> --}}
                {{-- <button type="button" class="btn btn-primary"> <i class="nav-icon i-Eye "></i> </button> --}}
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
        <td>
                <select class="form-control" id="product_id">
                    <option value="" selected disabled>Select Status</option>
                    {{-- @foreach ($products as $product) --}}
                        <option value="Pending">Pending</option>
                        <option value="Aproved">Approved</option>
                        <option value="Refunded">Refunded</option>
                        <option value="Rejected">Rejected</option>
                    {{-- @endforeach --}}
                </select>
        </td>
        <td>
            <button class="btn btn-primary ladda-button example-button m-1" data-style="expand-left"><span class="ladda-label">Update</span></button>
        </td>
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
<<<<<<< HEAD

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
            <th>Status</th>
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
                <td>{{$user->status}}</td>
                <td><a href="{{ route('user.edit', ['id' => $user->id]) }}" class="btn rounded-pill btn-icon btn-primary">
                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                </a></td>
            </tr>
        @endforeach
    </tbody>

        {{-- @foreach ($users as $value => $customers )
        <tr>
            <td>{{$value + 1}}</td>
            <td>{{$customers->id}}</td>
            <td>{{$customers->name}}</td>
            <td>{{$customers->email}}</td>
            <td>{{$customers->phone1}}</td>
            <td>{{$customers->country}}</td>
            <td>{{$customers->city}}</td>
            <td>{{$customers->addres}}</td>
            <td>{{$customers->status}}</td>
        </tr>
        @endforeach
=======
@elseif (Route::currentRouteName() == 'userlist' )
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
>>>>>>> main
    </tbody>
    <tfoot>

        <th>Sr No</th>
        <th>Name</th>
        <th>Phone Number</th>
        <th>Email</th>

    </tfoot>   --}}


    {{-- product info  --}}
@elseif (Route::currentRouteName() == 'allproducts' )
    <thead>
        <th>Sr No</th>
        <th>Name</th>
        <th>Model#</th>
        <th>SKU</th>
        <th>Category</th>
        <th>Image</th>
        <th>Type</th>
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
                                        <td>Image</td>
                                        <td>
                                            @if ($product->type == 'Parent')
                                                <span class="badge text-bg-success">{{ $product->type }}</span>
                                            @elseif ($product->type == 'Child')
                                                <span class="badge text-bg-success">{{ $product->type }}</span>
                                            @endif
                                        </td>
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
        <th>Name</th>
        <th>Model#</th>
        <th>SKU</th>
        <th>Category</th>
        <th>image</th>
        <th>Type</th>
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

    </thead>
    <tbody>
        @foreach ($data as $key => $menu)
        <tr>
            <td>{{ $key + 1 }}</td>
            <td>{{ $menu->id }}</td>
            <td>{{ $menu->name }}</td>
            <td><i class="{{ $menu->icon }}" style='color:#5233ff;  font-size: 30px;margin-right: 10px;'></i></td>
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
@elseif (Route::currentRouteName() == 'allcat' )
    <thead>
        <th>Sr No</th>
        <th>Id#</th>
        <th>Name</th>
        <th>Image</th>
        <th>Biller</th>

    </thead>
    <tbody>
        @foreach ($data as $key => $allcat)
        <tr>
            <td>{{ $key + 1 }}</td>
            <td>{{ $allcat->id }}</td>
            <td>{{ $allcat->name }}</td>
            <td><img src="<?php echo $allcat['img']; ?>" width="50" height="50"></td>
            <td>{{ $allcat->biller}}</td>

        </tr>
        @endforeach
    </tbody>
    <tfoot>
    <tr>
        <th>Sr No</th>
        <th>Id#</th>
        <th>Name</th>
        <th>Image</th>
        <th>Biller</th>

    </tr>
    </tfoot>

@elseif (Route::currentRouteName() == 'allsubcat' )
    <thead>
        <th>Sr No</th>
        <th>Id#</th>
        <th>Name</th>
        <th>Slug</th>
        <th>Image</th>
        <th>Biller</th>

    </thead>
    <tbody>
        @foreach ($data as $key => $allsubcat)
        <tr>
            <td>{{ $key + 1 }}</td>
            <td>{{ $allsubcat->category_id }}</td>
            <td>{{ $allsubcat->name }}</td>
            <td>{{ $allsubcat->slug }}</td>
            <td><img src="<?php echo $allsubcat['img']; ?>" width="50" height="50"></td>
            <td>{{ $allsubcat->biller}}</td>
        </tr>
        @endforeach
    </tbody>
    <tfoot>
    <tr>
        <th>Sr No</th>
        <th>Id#</th>
        <th>Name</th>
        <th>Slug</th>
        <th>Image</th>
        <th>Biller</th>

    </tr>
    </tfoot>

@endif

<script>
        $(function() {
            $("#example1").DataTable();
        });
    </script>
