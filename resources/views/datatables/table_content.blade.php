
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
        <td><span class="i-Eye-Visible"></span></td>    </tr>
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
        <th>Biller</th>

    </thead>
    <tbody>
        @foreach ($data as $key => $allcat)
        <tr>
            <td>{{ $key + 1 }}</td>
            <td>{{ $allcat->id }}</td>
            <td>{{ $allcat->name }}</td>
            <td>{{ $allcat->biller}}</td>
        </tr>
        @endforeach 
    </tbody>
    <tfoot>
    <tr>
        <th>Sr No</th>
        <th>Id#</th>
        <th>Name</th>
        <th>Biller</th>

    </tr>
    </tfoot>
    
@endif

<script>
        $(function() {
            $("#example1").DataTable();
        });
    </script>