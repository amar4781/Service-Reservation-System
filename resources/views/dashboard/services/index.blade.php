@extends('dashboard.dashboard')

@section('title','services')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Services</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('dashboard.home')}}">Home</a></li>
                        <li class="breadcrumb-item active">services</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <div class="d-flex flex-row-reverse mr-3 mb-3">
            <a href="{{ route("dashboard.services.create") }}" class="btn btn-primary btn-md d-flex align-items-center" style="gap: 10px;">
                <i class="nav-icon far fa-plus-square"></i>
                Add Service
            </a>
    </div>
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">List of services</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        @if(Session::has('success'))
                            <div class="alert alert-success" role="alert">
                                {{ Session::get('success') }}
                            </div>
                        @endif
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>No.</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Price</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($services as $service)
                            <tr>
                                <td>{{$service->id}}</td>
                                <td>{{$service->name}}</td>
                                <td>{{$service->description}}</td>
                                <td>{{number_format($service->price)}} L.E.</td>
                                <td>{{$service->status}}</td>
                                <td>
                                    <div class="d-flex align-items-center justify-content-end" style="gap: 16px;">
                                            <a href="{{ route("dashboard.services.edit", $service->id) }}" class="btn btn-outline-success">
                                                Edit
                                            </a>

                                            <button type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#modal-lg-{{ $service->id }}">
                                                Delete
                                            </button>

                                        <div class="modal fade" id="modal-lg-{{ $service->id }}">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="logoutModal">Confirm deletion</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <strong>Are you sure you want to delete it? You can't undo it again?</strong>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                        <form action="{{ route("dashboard.services.destroy", $service->id) }}" method="POST">
                                                            @csrf
                                                            @method("DELETE")
                                                            <button type="submit" class="btn btn-danger">Delete</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!--  -->
                </div>
            </div>
@endsection
