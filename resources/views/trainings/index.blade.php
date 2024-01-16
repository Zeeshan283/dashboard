@extends('layouts.master')
@section('page-css')
<link rel="stylesheet" href="{{ asset('assets/styles/vendor/datatables.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('website-assets/css/toastr.min.css') }}">
@endsection
@section('main-content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
    integrity="sha512-s9sR2uQ1C6e3pUaGZeYOKwJ+1tK1OlR0J07qL0vE0vOm2/JZSBXLhDkf5ypQyQ2jj/7Vb8S0s1JSbm6G4FfFAg=="
    crossorigin="anonymous" />
<div class="breadcrumb">
    <div class="col-md-6">
        <!-- Container-fluid starts-->
        <h5>Course Features Detail</h5>
    </div>
    <div class="col-md-6" style="text-align: right;  margin-left: auto;">
        <a href="{{ route('trainings.create') }}">
            <button class="btn btn-outline-secondary ladda-button example-button m-1" data-style="expand-left"><span
                    class="ladda-label">Add Course detail</span></button></a>
    </div>
    </a>
</div>
</div>

<div class="separator-breadcrumb border-top"></div>
<div class="col-md-12 mb-4">
    <div class="card text-start">
        <div class="card-body">
            <h4 class="card-title mb-3">All Course Features</h4>
            <div class="table-responsive">
                <table id="deafult_ordering_table" class="display table table-striped table-bordered"
                    style="width:100%">
                    <thead>
                        <tr>
                            <th>Sr No</th>
                            <th>Instructor</th>
                            <th>Category</th>
                            <th>Rating</th>
                            <th>Lectures</th>
                            <th>Duration</th>
                            <th>Skill Level</th>
                            <th>Language</th>
                            <th>Course Type</th>
                            <th>Address</th>
                            <th>Title</th>
                            <!-- <th>SubCategory</th> -->
                            <th>Image</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $key => $value)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $value->instructor->name ?? null }}</td>
                            <td>{{ $value->training_category->title  ?? null}}</td>

                            <td>
                                @php
                                $rating = $value->rating;
                                $maxRating = 100;
                                $numStars = 5;
                                $percentage = ($rating / $maxRating) * 100;
                                $fullStars = floor($percentage / (100 / $numStars));
                                $emptyStars = $numStars - $fullStars;
                                @endphp
                                <div class="star-rating">
                                    @for ($i = 0; $i < $fullStars; $i++) <i class="fas fa-star text-warning"></i>
                                        @endfor
                                        @for ($i = 0; $i < $emptyStars; $i++) <i class="far fa-star text-warning"></i>
                                            @endfor
                                </div>
                            </td>
                            <td>{{ $value->lectures }}</td>
                            <td>{{ $value->duration }}hrs</td>
                            <td>{{ $value->skilllevel }}</td>
                            <td>{{ $value->language }}</td>
                            <td>{{ $value->coursetype }}</td>
                            <td>{{ $value->address }}</td>
                            <td>{{ $value->title }}</td>
                            <td><img src="{{  $value->image }}" width="60px" height="40px">
                            </td>
                            <td>
                                <div class="d-flex gap-2">
                                    <a target="_blank" href="{{ route('trainings.edit', $value->id) }}">
                                        <button type="submit" class="btn rounded-pill btn-outline-secondary">
                                            <i class="fa fa-edit me-2 font-success" title="Edit" aria-hidden="true"></i>
                                        </button>
                                    </a>
                                    <!-- <a href="https://www.industrymall.net/blog/blogs/ {{ $value->id }}" target="_blank"
                                        class="btn btn-outline-secondary">
                                        <i class="nav-icon i-Eye" title="view"></i>
                                    </a> -->
                                    <form action="{{ route('trainings.destroy', $value->id) }}" method="POST"
                                        onsubmit="return confirm('Are you sure you want to delete this trainings page?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn rounded-pill btn-outline-secondary">
                                            <i class="fa fa-trash" title="delete" aria-hidden="true"></i>
                                        </button>
                                    </form>

                                    <!-- <a href="{{ asset('blog_categories/' . $value->id . '/destroy') }}">
                                                                    <i class="fa fa-trash font-danger"></i></a>
                                                               </a> -->
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Container-fluid Ends-->
</div>
@endsection
@section('page-js')
<script src="{{ asset('assets/js/vendor/datatables.min.js') }}"></script>
<script src="{{ asset('assets/js/datatables.script.js') }}"></script>
@endsection