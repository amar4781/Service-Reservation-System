@extends('dashboard.dashboard')

@section('title','reservations')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Reservations</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('dashboard.home')}}">Home</a></li>
                        <li class="breadcrumb-item active">reservations</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">List of reservations</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>No.</th>
                                <th>User Name</th>
                                <th>Service Name</th>
                                <th>Reservation date & time</th>
                                <th>Status</th>
                                <th>Status Edit</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($reservations as $reserve)
                            <tr>
                                <td>{{$reserve->id}}</td>
                                <td>{{$reserve->user->name}}</td>
                                <td>{{$reserve->service->name}}</td>
                                <td>{{$reserve->reservation_time}}</td>
                                <td>
                                    @if($reserve->status == 'pending')
                                        <span class="badge bg-warning">pending</span>
                                    @elseif($reserve->status == 'reserved')
                                        <span class="badge bg-success">reserved</span>
                                    @else
                                        <span class="badge bg-danger">canceled</span>
                                    @endif
                                </td>
                                <td>

                                    <button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#reserveStatusModal{{$reserve->id}}">
                                        Edit
                                    </button>

                                    <div class="modal fade" id="reserveStatusModal{{$reserve->id}}">
                                        <div class="modal-dialog" role="document">
                                            <form action="{{ route("dashboard.reservations.updateStatus",$reserve->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Edit Status of Reservation</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="mb-3">
                                                            <select name="status" class="form-control">
                                                                <option value="reserved" {{$reserve->status == 'reserved' ? 'selected' : ''}}>reserved</option>
                                                                <option value="canceled" {{$reserve->status == 'canceled' ? 'selected' : ''}}>canceled</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                        <button type="submit" class="btn btn-success">Edit</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
@endsection
