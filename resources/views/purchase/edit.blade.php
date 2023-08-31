@extends("app")
@section("contents")
    <section class="content-header">
        @include('errors.validation')
         <div class="container-fluid">
        @if (Session::has('flash_message'))
           <div class="alert alert-success">
            <a href="#" class="close" data-dismiss="alert" aria-hidden="true"  style="margin-right: 4%;">&times;</a>
            <strong>Success!</strong> {{ Session::get('flash_message') }}
            </div>
        @endif
      </div>
     <!--  <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Register Donor</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{asset('/home')}}">Dashboard</a></li>
              <li class="breadcrumb-item active">Register Donor</li>
            </ol>
          </div>
        </div>
      </div> -->
     </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header" style="background-color:blue;color: white;height: 55px;">
                <h3 class="card-title" style=""><b>Add Purchase</b></h3>
              



              </div>
              <!-- /.card-header -->
              <!-- form start -->
            
             
              {!! Form::model($edit, ['method' => 'PATCH', 'action' => ['App\Http\Controllers\PurchaseController@update', $edit->id], 'class' => 'form-horizontal', 'files' => 'true', 'enctype' => 'multipart/form-data']) !!}
                <div class="card-body">

               
         <input type="hidden" id="updatedby" name="updatedby" value="{{Auth::User()->name}}">

                  <!----->
       
                  <!---->
                  <!-------->
                   <div class="col-md-12">
        <div class="row">
      <div class="col-md-3">
        <div class="form-group">
          <label for="exampleFormControlSelect1">Date</label>
          <input id="date" type="date" value="<?php echo date('Y-m-d');?>" name="date" class="form-control"> 
        </div></div>
        <div class="col-md-3">
          <div class="form-group">
            <label for="exampleFormControlInput1">Bill No</label>
          {!! Form::text('bill_no', $codes, ['id' => 'bill_no','class'=>'form-control'])!!}
          </div>
        </div>
      </div></div>
                  <!-------->
                  <div class="col-md-12">
          <div class="form-group">
            <label for="exampleFormControlSelect1 form-control">Select Supplier</label>
             {!! Form::select('supplier_id',$c, null, ['id' => 'supplier_id', 'class'=>'form-control']) !!}
          </div>
        </div>
             <!-------------->



        <div class="col-md-12">
        <div class="row">
          <div class="col-md-1">
            <div class="form-group">
              <label for="exampleFormControlInput1">Code</label>
              {!! Form::text('code', null, ['id' => 'code','class'=>'form-control',  'autofocus'=>'autofocus']) !!}
            </div>
          </div>
      <div class="col-md-3">
        <div class="form-group">
          <label for="exampleFormControlSelect1">Product Name</label>
           {!! Form::select('produc_id', $p, null, ['id' => 'produc_id', 'onchange' => 'productMouseUp($(this).val());','class'=>'form-control']) !!}
        </div>
      </div>
        <div class="col-md-2">
          <div class="form-group">
            <label for="exampleFormControlSelect1">Unit</label>
             {!! Form::select('unit_id', $uom, null, ['id' => 'unit_id','class'=>'form-control']) !!}
          </div></div>
          <div class="col-md-1">
            <div class="form-group">
              <label for="exampleFormControlInput1">Quantity</label>
              {!! Form::text('qauntity', null, ['id' => 'qauntity','class'=>'form-control', 'onkeyup' => 'QuantityKeyUp($(this).val())']) !!}
            </div>
          </div>
          <div class="col-md-2">
            <div class="form-group">
              <label for="exampleFormControlInput1">Cost</label>
              {!! Form::text('cost', null, ['id' => 'cost','class'=>'form-control',  'onkeyup' => 'PriceKeyUp($(this).val())']) !!}
            </div>
          </div>
          <div class="col-md-2">
            <div class="form-group">
              <label for="exampleFormControlInput1">Total</label>
              {!! Form::text('total', null, ['id' => 'total','class'=>'form-control', 'onkeyup' => 'AddGridData()']) !!}
            </div>
          </div>

          <!----->
          <div class="col-md-1">
            <div class="form-group">
              <label for="exampleFormControlInput1">Action</label>
            <button class="btn btn-danger">Delete</button> 
            </div>
          </div>
       
      </div>
    </div>

<div id="myData">

    </div>














           <!----------->
 <div class="col-md-12" style="background-color: skyblue;">
      <div class="row">
        <div class="col-md-6 mt-4">
            <h4 style="color: snow;"><b>Total Records</b></h4>
        </div>
        <div class="col-md-3">
          <div class="form-group">
            <label for="exampleFormControlInput1">Total Quantity</label>
             {!! Form::text('total_quantity', null, ['id' => 'total_quantity','class'=>'form-control']) !!}
          </div>
        </div>
        <div class="col-md-3">
          <div class="form-group">
            <label for="exampleFormControlInput1">Total Amount</label>
             {!! Form::text('total_amount', null, ['id' => 'total_amount','class'=>'form-control']) !!}
          </div>
        </div>
      </div>
    </div>
             
                </div>
                <!-- /.card-body -->


                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                    
                </div>
              {!! Form::close() !!}
            </div>


          </div>
          <!--/.col (left) -->
          <!-- right column -->
          
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->




@section("scripts")
<script type="text/javascript">

function QuantityKeyUp(quantity){
   var price = document.getElementById('cost').value;

     

      total = (quantity * price);
      document.getElementById('total').value = total;

    }
function PriceKeyUp(price){
      var quantity = document.getElementById('qauntity').value;
      
      total = (price * quantity);
     // alert(total);
      document.getElementById('total').value = total;
    }
function productMouseUp(productID){
  //alert(productID);
     // var id = document.getElementById('produc_id').value.split("_")[0];
     // var product_name = document.getElementById('produc_id').value.split("_")[1];
      var cost = document.getElementById('produc_id').value.split("_")[2];
      var code = document.getElementById('produc_id').value.split("_")[3];
     // alert(cost)
      document.getElementById('cost').value = cost;
      document.getElementById('code').value = code;

     
    }
      function myDeleteFunction(row) {
      //alert(row)
  
      $(row).remove();
        
   

   
  }



function AddGridData(){

     
var code = document.getElementById('code').value;
var q = document.getElementById('qauntity').value;
var cost = document.getElementById('cost').value;
var total = document.getElementById('total').value;
var productID = document.getElementById('produc_id').value.split("_")[0];
var productName = document.getElementById('produc_id').value.split("_")[1];
var unitID = document.getElementById('unit_id').value.split("_")[0];
var unitName = document.getElementById('unit_id').value.split("_")[1];
//var productName = document.getElementById('produc_id').value.split("_").pop();

  // alert(productID)
  // alert(productName)
//var unit = document.getElementById('unit_id').value;
   var tableHtml = '<div class="col-md-12">';
       tableHtml += ` <div class="row">`;



         tableHtml += ` <div class="col-md-1">`;
           tableHtml += ` <div class="form-group">`;
             // tableHtml += `<label for="exampleFormControlInput1">Code</label>`;
              tableHtml += `{!! Form::text('code[]', '${code}', ['id' => 'code', 'class'=>'form-control']) !!}`;
            tableHtml += `</div>`;
          tableHtml += `</div>`;
           tableHtml += `<div class="col-md-4"  style="display:none;">`;
         tableHtml += `<div class="form-group">`;
           tableHtml += ` {!! Form::text('produc_id[]', '${productID}', ['id' => 'produc_id','class'=>'form-control']) !!}`;
             tableHtml += `</div>`;
          tableHtml += `</div>`;

            tableHtml += `<div class="col-md-3">`;
         tableHtml += `<div class="form-group">`;
           tableHtml += ` {!! Form::text('produc_name[]', '${productName}', ['id' => 'produc_name','class'=>'form-control']) !!}`;
             tableHtml += `</div>`;
          tableHtml += `</div>`;

          tableHtml += `<div class="col-md-3" style="display:none;">`;
         tableHtml += `<div class="form-group">`;
           tableHtml += ` {!! Form::text('unit_id[]', '${unitID}', ['id' => 'unit_id','class'=>'form-control']) !!}`;
             tableHtml += `</div>`;
          tableHtml += `</div>`;

          tableHtml += `<div class="col-md-2">`;
         tableHtml += `<div class="form-group">`;
          // tableHtml += `<label for="exampleFormControlSelect1">Unit</label>`;
            tableHtml += `{!! Form::text('unit_name[]', '${unitName}', ['id' => 'unit_name','class'=>'form-control']) !!}`;
          tableHtml += `</div>`;
          tableHtml += `</div>`;
         tableHtml += `<div class="col-md-1">`;
            tableHtml += `<div class="form-group">`;
         //   tableHtml +=  `<label for="exampleFormControlInput1">Quantity</label>`;
             tableHtml += `{!! Form::text('qauntity[]', '${q}', ['id' => 'qauntity','class'=>'form-control']) !!}`;
            tableHtml += `</div>`;
          tableHtml += `</div>`;
          tableHtml += `<div class="col-md-2">`;
            tableHtml += `<div class="form-group">`;
           //  tableHtml += `<label for="exampleFormControlInput1">Cost</label>`;
              tableHtml += `{!! Form::text('cost[]', '${cost}', ['id' => 'cost','class'=>'form-control']) !!}`;
           tableHtml += `</div>`;
          tableHtml += `</div>`;
          tableHtml += `<div class="col-md-2">`;
            tableHtml += `<div class="form-group">`;
            //  tableHtml += `<label for="exampleFormControlInput1">Total</label>`;
              tableHtml += `{!! Form::text('total[]', '${total}', ['id' => 'total','class'=>'form-control', 'onkeyup' => 'AddGridData()']) !!}`;
         tableHtml += `</div>`;
      tableHtml += ` </div>`;

       tableHtml += `<div class="col-md-1">`;
            tableHtml += `<div class="form-group">`;
            //  tableHtml += `<label for="exampleFormControlInput1">Total</label>`;
              tableHtml += `<button type="button" class="btn btn-danger" name="btn" id="btn"><i onclick="javascript:myDeleteFunction($(this).closest(\'row\'));" class="icon-trash">Delete</button>`;
         tableHtml += `</div>`;
      tableHtml += ` </div>`;


        tableHtml += `</div>`;
      tableHtml += '</div>';
    $('#myData').append(tableHtml);
  document.getElementById('code').focus();
 

  }

</script>

<!-- Select2-->

<script type="text/javascript">
  $("#produc_id").select2();
  $("#produc_id").next(".select2").find(".select2-selection").focus(function() {
  $("#produc_id").select2("open");
     });

  $("#supplier_id").select2();
  $("#supplier_id").next(".select2").find(".select2-selection").focus(function() {
  $("#supplier_id").select2("open");
     });

  $("#unit_id").select2();
  $("#unit_id").next(".select2").find(".select2-selection").focus(function() {
  $("#unit_id").select2("open");
     });
</script>
@stop

 @stop


 
