@extends('layouts.master')
@section('page-css')
    <link rel="stylesheet" href="{{ asset('assets/styles/vendor/datatables.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('website-assets/css/toastr.min.css') }}">
@endsection

@section('main-content') 
    <div class="page-body">
        <!-- Container-fluid starts-->
        <div class="container-fluid " id="">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>Training Detail</h5>
                        </div>
                        <div class="card-body">
                        <form method="post" action="{{ route('cfeatures.update',[$edit->id]) }}" enctype="multipart/form-data">
                                @csrf
                                @method('PATCH')
                                <div class="card mb-4">
                                    <h5 class="card-header text-left">Edit Course Features</h5>
                                    <hr class="my-0"/>
                                    <div class="card-body">
                                        <div class="row">
        <div class="col-sm-6">
            <div class="form-group" ml-10>
                <label for="instructor" class="form-label">Instructor</label>
                <input type="text" class="form-control" id="instructor" placeholder="Instructor Name" name="instructor" value="{{$edit->instructor}}" required>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label for="rating" class="form-label">Rating</label>
                <input type="text" class="form-control" id="rating" placeholder="Total rating" name="rating" value="{{$edit->rating}}" required>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label for="lectures" class="form-label">Lectures</label>
                <input type="text" class="form-control" id="lectures" placeholder="Total lectures" name="lectures" value="{{$edit->lectures}}"required>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label for="duration" class="form-label">Duration</label>
                <!-- <input type="text" class="form-control" id="duration" placeholder="duration" name="duration" required> -->
                <select class="form-select" id="duration" name="duration">
                <option value=""> --- Please Select --- </option>
<option>1</option>
<option>2</option>
<option>3</option>
<option>4</option>
<option>5</option>
<option>6</option>
<option>7</option>
<option>8</option>
<option>9</option>
<option>10</option>
                </select>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
            <label for="skilllevel" class="form-label">Skill Level</label>
                      <select class="form-select" id="skilllevel" name="skilllevel">
                        <option value=""> Please Select </option>
                        <option>Basic Level</option>
                        <option>Intermediate</option>
                        <option>Expert Level</option>
                      </select>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
            <label for="language" class="form-label">Languages</label>
                      <select class="form-select" id="language" name="language">
                        <option value=""> --- Please Select --- </option>
                       
                        <option>Oman</option>
                        <option selected="selected">Pakistan</option>
                        <option>Turkey</option>
                        <option>Uganda</option>
                        <option>Ukraine</option>
                        <option>United Arab Emirates</option>
                        <option>United Kingdom</option>
                        <option>United States</option>
                        <option>United States Minor Outlying Islands</option>
                        <option>Uruguay</option>
                        <option>Uzbekistan</option>
                        <option>Vanuatu</option>
                        <option>Yemen</option>
                        <option>Zambia</option>
                        <option>Zimbabwe</option>
                        <option>Spain</option>
                      </select>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label for="coursetype" class="form-label">Course Type</label>
                <!-- <input type="text" class="form-control" id="duration" placeholder="duration" name="duration" required> -->
                <select class="form-select" id="coursetype" name="coursetype">
                <option value="coursetype"> --- Please Select --- </option>
<option>Online</option>
<option>Onsite</option>
                </select>
            </div>
        </div>
        <div class="col-sm-6" id="addressField">
    <div class="form-group" ml-10>
        <label for="address" class="form-label">Address</label>
        <input type="text" class="form-control" id="address" placeholder="Enter Address here" name="address" value="{{$edit->address}}">
    </div>
</div>
                                            </div> 
                                        </div>
                                        <div class="mt-2 " style="text-align: right">
                                            <button type="submit" class="btn btn-outline-secondary  me-2">Add</button>
                                        </div>
                                    </div>
                                    <!-- /Account -->
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    $(document).ready(function () {
        // Hide the address field initially
        $('#addressField').hide();

        // Add an event listener to the type select element
        $('#coursetype').change(function () {
            // Show the address field if "Onsite" is selected, otherwise hide it
            if ($(this).val() === 'Onsite') {
                $('#addressField').show();
            } else {
                $('#addressField').hide();
            }
        });
    });
</script>
    @endsection

@section('page-js')
<script src="{{ asset('assets/js/vendor/datatables.min.js') }}"></script>
<script src="{{ asset('assets/js/datatables.script.js') }}"></script>
@endsection


