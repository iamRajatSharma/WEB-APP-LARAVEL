@extends('admin.layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Services / Create</h1>
                </div>
                <!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                    </ol>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <section class="content  h-100"">
        <div class="container-fluid  h-100"">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-md-12 ">
                    <form action="{{ route('store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card">
                            <div class="card-header">
                                {{-- <a href="{{ route('serviceList') }}" class="btn btn-primary">Back</a> --}}
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">Name <b title="required" class="text-danger">*</b></label>
                                    <input type="text" name="name" id="name" class="form-control"
                                        value="{{ old('name') }}">
                                    @error('name')
                                        <p class="text-danger"><b>{{ $message }}</b></p>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="name">Description <b title="required" class="text-danger">*</b></label>
                                    <textarea name="description" id="description" class="summernote">{{ old('description') }}</textarea>
                                    @error('description')
                                        <p class="text-danger"><b>{{ $message }}</b></p>
                                    @enderror
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="Image">Image</label>
                                        <input type="file" style="padding: 3px;" name="image" id="image"
                                            class="form-control">
                                        @error('image')
                                            <p class="text-danger"><b>{{ $message }}</b></p>
                                        @enderror

                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="status">Status</label>
                                            <select name="status" id="status" class="form-control">
                                                <option value="1">Active</option>
                                                <option value="0">Block</option>
                                            </select>
                                            @error('status')
                                                <p class="text-danger"><b>{{ $message }}</b></p>
                                            @enderror
                                        </div>

                                    </div>
                                </div>

                                <div class="col-md-12 mb-3">
                                    <label for="">Short Description <b title="required"
                                            class="text-danger">*</b></label>
                                    <textarea name="short_description" id="short_description" cols="30" rows="7" class="form-control">{{ old('short_description') }}</textarea>
                                    @error('short_description')
                                        <p class="text-danger"><b>{{ $message }}</b></p>
                                    @enderror
                                </div>

                                <center>
                                    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                                </center>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /.row -->
            <!-- /.row (main row) -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection


@section('extraJs')
@endsection
