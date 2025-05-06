@extends('dashboard.dashboard')

@section('title','Edit service')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Edit Service</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('dashboard.home')}}">Home</a></li>
                        <li class="breadcrumb-item active">edit service</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <div class="d-flex flex-row-reverse mr-3 mb-3">
        <a href="{{ route("dashboard.services.index") }}" class="btn btn-danger btn-md d-flex align-items-center" style="gap: 10px;">
            <i class="nav-icon fa fa-angle-double-left"></i>
            back
        </a>
    </div>

    <div class="col-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Edit Service</h3>
        </div>

        <div class="card-body">
            <form action="{{ route("dashboard.services.update",$service->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control @error("name") is-invalid @enderror" name="name" id="title" value="{{ old("name", $service->name) }}">
                    @error("name") <p class="text-danger">{{ $message }}</p> @enderror
                </div>

                <div class="form-group">
                    <label>Description</label>
                    <textarea name="description" class="form-control" rows="4">{{ old('description', $service->description) }}</textarea>
                    @error("description") <p class="text-danger">{{ $message }}</p> @enderror
                </div>

                <div class="form-group">
                    <label>Price</label>
                    <input type="number" step="0.01" name="price" class="form-control @error("price") is-invalid @enderror" value="{{ old("price",$service->price) }}">
                    @error("price") <p class="text-danger">{{ $message }}</p> @enderror
                </div>

                <div class="form-group">
                    <label>Status</label>
                    <select name="status" class="form-control @error('status') is-invalid @enderror">
                        <option value="available" {{ old('status', $service->status ?? '') == 'available' ? 'selected' : '' }}>available</option>
                        <option value="not_available" {{ old('status', $service->status ?? '') == 'not_available' ? 'selected' : '' }}>not available</option>
                    </select>
                    @error("status") <p class="text-danger">{{ $message }}</p> @enderror
                </div>

                <button type="submit" class="btn btn-block btn-success btn-md w-auto">Edit</button>
            </form>
        </div>
    </div>
    </div>
@endsection
