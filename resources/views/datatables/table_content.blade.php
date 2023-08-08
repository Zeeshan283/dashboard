
@if (Route::currentRouteName() == 'allorders')
        <thead>
            <th>Sr No</th>
            <th>Order #</th>
            <th>Customer Name</th>
            <th>Order Date</th>
            <th>Shipping Date</th>
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
            <th>Order #</th>
            <th>Customer Name</th>
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
        <th>Order Date</th>
        <th>Shipping Date</th>
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
        <th>Alret</th>
        <th>Reviews</th>
        <th>Actions</th>
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
        <th>Order #</th>
        <th>Customer Name</th>
        <th>Order Date</th>
        <th>Shipping Date</th>
        <th>Status</th>
        <th>View Invoice</th>
        <th>Alret</th>
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
        <th>View Invoice</th>
        <th>Alret</th>
        <th>Reviews</th>
        <th>Actions</th>
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
        <th>Order #</th>
        <th>Customer Name</th>
        <th>Order Date</th>
        <th>Shipping Date</th>
        <th>Status</th>
        <th>View Invoice</th>
        <th>Alret</th>
        <th>Reviews</th>
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
        <th>Type</th>
        <th>Action</th>
    </thead>
    <tbody>
<<<<<<< HEAD
    <tr>
        <td>Tiger Nixon</td>
        <td>System Architect</td>
        <td>Edinburgh</td>
        <td>61</td>
        <td>2011/04/25</td>
        <td>parent</td>
        <td>
            <a href="#" class="text-success me-2">
                <i class="nav-icon i-Pen-2 font-weight-bold"></i>
            </a>
            <a href="#" class="text-danger me-2">
                <i class="nav-icon i-Close-Window font-weight-bold"></i>
            </a>
            <button class="btn btn-danger"><a href="#" >
                <i class="nav-icon i-Eye-Scan   font-weight-bold"></i>
            </a></button>
        </td>
    </tr>
=======
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
                                        <td>
                                            @if ($product->type == 'Parent')
                                                <span class="badge text-bg-success">{{ $product->type }}</span>
                                            @elseif ($product->type == 'Child')
                                                <span class="badge text-bg-success">{{ $product->type }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            <!-- <div class="btn-group mr-2" role="group" aria-label="First group">
                                                <a href="{{ URL::to('products/' . $product->id . '/edit') }}"
                                                    class="btn-info btn-sm"><i class="fa fa-pencil"></i></a>
                                                <a onclick="return confirm('Are you sure you want to delete?')"
                                                    href="{{ asset('products') }}/{{ $product->id }}/destroy"
                                                    class="btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                                                <a href="{{ URL::to('single-product/' . $product->id . '/' . $product->slug) }}"
                                                    class="btn-warning btn-sm" target="_blank"><i class="fa fa-eye"></i></a>
                                                    <a href="{{ URL::to('products/' . $product->id . '/dupe') }}"
                                                        class="btn-success btn-sm"><i class="fa fa-clone"></i></a>
                                            </div> -->
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
                                
        
>>>>>>> refs/remotes/origin/main
    </tbody>
    <tfoot>
    <tr>
        <th>Sr No</th>
        <th>Name</th>
        <th>Model#</th>
        <th>SKU</th>
        <th>Category</th>
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
    
@endif

<script>
        $(function() {
            $("#example1").DataTable();
        });
    </script>