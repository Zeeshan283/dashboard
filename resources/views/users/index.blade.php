@extends('layouts.master')

@section('main-content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <div class="separator-breadcrumb border-top"></div>

    <div class="col-md-12 mb-4">
        <div class="card text-start">

            <div class="card-body">
                <h4 class="card-title mb-3">User List</h4>

                <div class="table-responsive">
                    <table id="customer_list_table" class="display table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Contact Number</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Address</th>
                                <th>Zipcode</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                            <tr>
                                <td>{{$user["id"]}}</td>
                                {{-- <td>{{ $user->first_name}}</td>
                                <td>{{ $user->last_name }}</td>
                                <td>{{ $user->contact_number }}</td>
                                <td>{{ $user->username }}</td>
                                <td>{{ $user->email}}</td>
                                <td>{{ $user->address}}</td>
                                <td>{{ $user->zipcode}}</td>
                                <td>{{ $user->status}}</td>
                            </tr> --}}
                            <td>{{$data["first_name"]}}</td>
                            <td>{{$data["last_name"]}}</td>
                            <td>{{$data["contact_number"]}}</td>
                            <td>{{$data["username"]}}</td>
                            <td>{{$data["email"]}}</td>
                            <td>{{$data["address"]}}</td>
                            <td>{{$data["zipcode"]}}</td>
                            <td>{{$data["status"]}}</td>
                            <td><a href="{{url('/admin/edit-service/' . $user['id'])}}" class="btn rounded-pill btn-icon btn-primary"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></td>
                            <td><a href="{{url('/admin/edit-service/' . $user['id'])}}" class="btn rounded-pill btn-icon btn-primary"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></td>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('page-js')
<script src="{{ asset('assets/js/vendor/datatables.min.js') }}"></script>
<script>
    $(document).ready(function () {
        $('#customer_list_table').DataTable();
    });
</script>
@endsection


