@section('page-css')
    <link rel="stylesheet" href="{{asset('assets/styles/vendor/quill.bubble.css')}}">
    <link rel="stylesheet" href="{{asset('assets/styles/vendor/quill.snow.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/styles/vendor/datatables.min.css') }}">
@endsection
@section('main-content')

@section('main-content')
            <div class="breadcrumb">
                <h1>Add Product</h1>
            </div>

            <div class="separator-breadcrumb border-top"></div>
            <div class="2-columns-form-layout">
                <div class="">
                    <div class="row">
                        <div class="col-lg-12">
                            <!--begin::form 3 Horizontal-->
                            <form action="">
                                <!-- start card 3 Columns Horizontal Form Layout-->
                                <div class="card ul-card__margin-25">
                                    <div class="card-header bg-transparent">
                                        <h3 class="card-title">Add Product Form</h3>
                                    </div>

                                    <div class="card-body">
                                        <div class="form-group row">
                                            <label for="staticEmail19" class="ul-form__label ul-form--margin col-lg-1   col-form-label ">Model No:</label>
                                            <div class="col-lg-3 ">
                                                <input type="text" class="form-control" id="staticEmail19" placeholder="Enter Model Number">
                                                {{-- <small id="passwordHelpBlock" class="ul-form__text form-text ">
                                                    Please enter Model Number of the Product
                                                </small> --}}
                                            </div>

                                            <label for="staticEmail20" class="ul-form__label ul-form--margin col-lg-1 col-form-label ">Product Name:</label>
                                            <div class="col-lg-3">
                                                <input type="text" class="form-control" id="staticEmail20" placeholder="Enter Your Product Name"> <br>
                                                {{-- <small id="passwordHelpBlock" class="ul-form__text form-text ">
                                                    Please enter Product name
                                                </small> --}}
                                            </div>

                                            <label for="inputEmail4" class="ul-form__label ul-form--margin col-lg-1 col-form-label ">Condition:</label>
                                            <div class="form-group col-lg-3">
                                                <div class="input-group">
                                                    <input type="text" class="form-control" aria-label="Text input with dropdown button">
                                                    <button class="btn btn-outline-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Dropdown</button>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item" href="#">New</a>
                                                        <a class="dropdown-item" href="#">Refurbished</a>
                                                    </div>
                                                </div>
                                                {{-- <small id="passwordHelpBlock" class="ul-form__text form-text ">
                                                    Select product condition
                                                </small> --}}
                                            </div>

                                            <label for="staticEmail20" class="ul-form__label ul-form--margin col-lg-1 col-form-label ">New Price:</label>
                                            <div class="col-lg-3">
                                                <input type="text" class="form-control" id="staticEmail20" placeholder="Enter New Price"> <br>
                                                {{-- <small id="passwordHelpBlock" class="ul-form__text form-text ">
                                                    Please enter Product New Price
                                                </small> --}}
                                            </div>

                                            <label for="staticEmail20" class="ul-form__label ul-form--margin col-lg-1 col-form-label ">N.Sale Price:</label>
                                            <div class="col-lg-3">
                                                <input type="text" class="form-control" id="staticEmail20" placeholder="Enter N.Sale Price">
                                                {{-- <small id="passwordHelpBlock" class="ul-form__text form-text ">
                                                    Please enter Product N.Sale Price
                                                </small> --}}
                                            </div>

                                            <label for="staticEmail20" class="ul-form__label ul-form--margin col-lg-1 col-form-label ">N.Warranty Days:</label>
                                            <div class="col-lg-3">
                                                <input type="text" class="form-control" id="staticEmail20" placeholder="Enter N.Warranty Days">
                                                {{-- <small id="passwordHelpBlock" class="ul-form__text form-text ">
                                                    Please enter Product N.Warranty Days
                                                </small> --}}
                                            </div>

                                            <label for="staticEmail20" class="ul-form__label ul-form--margin col-lg-1 col-form-label ">N.Return Days:</label>
                                            <div class="col-lg-3">
                                                <input type="text" class="form-control" id="staticEmail20" placeholder="Enter N.Return Days"> <br>
                                                {{-- <small id="passwordHelpBlock" class="ul-form__text form-text ">
                                                    Please enter Product N.Return Days
                                                </small> --}}
                                            </div>

                                            <label for="staticEmail20" class="ul-form__label ul-form--margin col-lg-1 col-form-label ">Refurbished Price:</label>
                                            <div class="col-lg-3">
                                                <input type="text" class="form-control" id="staticEmail20" placeholder="Enter Refurbished Price">
                                                {{-- <small id="passwordHelpBlock" class="ul-form__text form-text ">
                                                    Please enter Product Refurbished Price
                                                </small> --}}
                                            </div>
                                            <label for="staticEmail20" class="ul-form__label ul-form--margin col-lg-1 col-form-label ">R.Sale Price:</label>
                                            <div class="col-lg-3">
                                                <input type="text" class="form-control" id="staticEmail20" placeholder="Enter R.Sale Price">
                                                {{-- <small id="passwordHelpBlock" class="ul-form__text form-text ">
                                                    Please enter Product R.Sale Price
                                                </small> --}}
                                            </div>
                                            <label for="staticEmail20" class="ul-form__label ul-form--margin col-lg-1 col-form-label ">R.Warranty Days:</label>
                                            <div class="col-lg-3">
                                                <input type="text" class="form-control" id="staticEmail20" placeholder="Enter R.Warranty Days">
                                                {{-- <small id="passwordHelpBlock" class="ul-form__text form-text ">
                                                    Please enter Product R.Warranty Days </small> --}}
                                            </div>
                                            <label for="staticEmail20" class="ul-form__label ul-form--margin col-lg-1 col-form-label ">R.Return Days:</label>
                                            <div class="col-lg-3">
                                                <input type="text" class="form-control" id="staticEmail20" placeholder="Enter Refurbished Price">
                                                {{-- <small id="passwordHelpBlock" class="ul-form__text form-text ">
                                                    Please enter Product R.Return Days
                                                </small> --}}
                                            </div>
                                            <label for="staticEmail20" class="ul-form__label ul-form--margin col-lg-1 col-form-label ">Min Order:</label>
                                            <div class="col-lg-3">
                                                <input type="text" class="form-control" id="staticEmail20" placeholder="Enter Minimum Order Quantity"> <br>
                                                {{-- <small id="passwordHelpBlock" class="ul-form__text form-text ">
                                                    Please enter Minimum order quantity
                                                </small> --}}
                                            </div>
                                            <label for="staticEmail20" class="ul-form__label ul-form--margin col-lg-1 col-form-label ">SKU:</label>
                                            <div class="col-lg-3">
                                                <input type="text" class="form-control" id="staticEmail20" placeholder="Enter Product SKU">
                                                {{-- <small id="passwordHelpBlock" class="ul-form__text form-text ">
                                                    Please enter Product Refurbished Price
                                                </small> --}}
                                            </div>

                                            <label for="inputEmail4" class="ul-form__label ul-form--margin col-lg-1 col-form-label ">Make:</label>
                                            <div class="form-group col-lg-3">
                                                <div class="input-group">
                                                    <input type="text" class="form-control" aria-label="Text input with dropdown button">
                                                    <button class="btn btn-outline-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Dropdown</button>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item" href="#">Super Admin</a>
                                                        <a class="dropdown-item" href="#">Industry Mall</a>
                                                    </div>
                                                </div>
                                            </div>

                                            <label for="staticEmail20" class="ul-form__label ul-form--margin col-lg-1 col-form-label ">Select Image:</label>
                                            <div class="col-lg-3">
                                                <input type="file" class="form-control" id="staticEmail20" placeholder="Enter Product SKU">
                                                {{-- <small id="passwordHelpBlock" class="ul-form__text form-text ">
                                                    Please enter Product Refurbished Price
                                                </small> --}}
                                            </div>

                                            
                                        

                                            {{-- testing multiple instances  --}}

                                            <div class="col-md-6 mb-4" style="padding-left: 50px">
                                                <div>
                                                    <div class="card-body">
                                                        <h2>Description</h2>
                                                        {{-- <p>Enter Product Description 1</p> --}}
                                                        <div class="mx-auto col-md-12">
                                                            <div id="snow-editor-1" class="editor-container">
                                                                <!-- Content will be generated by Quill -->
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-6 mb-4" style="padding-right: 50px">
                                                <div>
                                                    <div class="card-body">
                                                        <h2>Details</h2>
                                                        {{-- <p>Enter Product Description 2</p> --}}
                                                        <div class="mx-auto col-md-12">
                                                            <div id="snow-editor-2" class="editor-container">
                                                                <!-- Content will be generated by Quill -->
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                              

                                        <div class="custom-separator"></div>

                                        <div class="form-group row">
                                            <label for="staticEmail22" class="ul-form__label ul-form--margin col-lg-1 col-form-label ">Contact:</label>
                                            <div class="col-lg-3">
                                                <input type="text" class="form-control" id="staticEmail22" placeholder="Enter contact number">
                                                <small id="passwordHelpBlock" class="ul-form__text form-text ">
                                                    Please enter your contact number
                                                </small>
                                            </div>

                                            <label for="staticEmail23" class="ul-form__label ul-form--margin col-lg-1 col-form-label ">Fax:</label>
                                            <div class="col-lg-3">

                                                <div class="input-right-icon">
                                                    <input type="text" class="form-control" id="staticEmail23" placeholder="Enter your fax">
                                                    <span class="span-right-input-icon">
                                                        <i class="ul-form__icon i-Information"></i>
                                                    </span>
                                                </div>

                                                <small id="passwordHelpBlock" class="ul-form__text form-text ">
                                                    Please enter your fax
                                                </small>
                                            </div>

                                            <label for="staticEmail24" class="ul-form__label ul-form--margin col-lg-1 col-form-label ">Address:</label>
                                            <div class="col-lg-3">

                                                <div class="input-right-icon">
                                                    <input type="text" class="form-control" id="staticEmail24" placeholder="Enter your address">
                                                    <span class="span-right-input-icon">
                                                        <i class="ul-form__icon i-Map-Marker"></i>
                                                    </span>
                                                </div>

                                                <small id="passwordHelpBlock" class="ul-form__text form-text ">
                                                    Please enter your address
                                                </small>
                                            </div>
                                        </div>





                                        <div class="custom-separator"></div>
                                        <div class="form-group row">

                                            <label for="staticEmail25" class="ul-form__label ul-form--margin col-lg-1 col-form-label ">Postcode:</label>
                                            <div class="col-lg-2">
                                                <div class="input-right-icon">
                                                    <input type="text" class="form-control" id="inputEmail25" placeholder="Enter your postcode">
                                                    <span class="span-right-input-icon">
                                                        <i class="ul-form__icon i-New-Mail"></i>
                                                    </span>
                                                </div>

                                                <small id="passwordHelpBlock" class="ul-form__text form-text ">
                                                    Please enter your postcode
                                                </small>
                                            </div>

                                            <label for="staticEmail26" class="ul-form__label ul-form--margin col-lg-1 col-form-label ">User
                                                Group:</label>
                                            <div class="col-lg-2">

                                                <div class="ul-form__radio-inline">
                                                    <label class=" ul-radio__position radio radio-primary form-check-inline">
                                                        <input type="radio" name="radio" value="0">
                                                        <span class="ul-form__radio-font">Sales Person</span>
                                                        <span class="checkmark"></span>
                                                    </label>
                                                    <label class="ul-radio__position radio radio-primary">
                                                        <input type="radio" name="radio" value="0">
                                                        <span class="ul-form__radio-font">Customer</span>
                                                        <span class="checkmark"></span>
                                                    </label>
                                                </div>

                                                <small id="passwordHelpBlock" class="ul-form__text form-text ">
                                                    Please enter your address
                                                </small>
                                            </div>



                                        </div>



                                    </div>
                                    <div class="card-footer">
                                        <div class="mc-footer">
                                            <div class="row text-center">
                                                <div class="col-lg-12 ">
                                                    <button type="button" class="btn btn-primary m-1">Save</button>
                                                    <button type="button" class="btn btn-outline-secondary m-1">Cancel</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end card 3 Columns Horizontal Form Layout-->
                            </form>
                            <!-- end::form 3-->



                        </div>

                    </div>
                    <!-- end of main row -->
                </div>
            </div>

@endsection

@section('page-js')

<script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/highlight.min.js"></script>
<script src="{{asset('assets/js/vendor/quill.min.js')}}"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const editorContainers = document.querySelectorAll('.editor-container');

        editorContainers.forEach((container, index) => {
            const editor = new Quill(container, {
                theme: 'snow',
                // Add any other Quill configuration options you need.
            });
        });
    });
</script>

@endsection

@section('bottom-js')

<script src="{{asset('assets/js/quill.script.js')}}"></script>

<script src="{{ asset('assets/js/vendor/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/js/datatables.script.js') }}"></script>


@endsection
