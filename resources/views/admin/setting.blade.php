@extends('admin.layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Setting / Create</h1>
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
                    @if (Session::has('type'))
                        <div class="alert alert-{{ Session::get('type') }}">
                            <strong>{{ Session::get('message') }}</strong>
                        </div>
                    @endif
                    <form action="{{ route('setting.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card">
                            <div class="card-header">
                                {{-- <a href="{{ route('serviceList') }}" class="btn btn-primary">Back</a> --}}
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-lg-6">
                                        <label for="name">Website Name <b title="required"
                                                class="text-danger">*</b></label>
                                        <input type="text" name="name" id="name" class="form-control"
                                            value="{{ $setting->website_title }}">
                                        @error('name')
                                            <p class="text-danger"><b>{{ $message }}</b></p>
                                        @enderror
                                    </div>

                                    <div class="form-group col-lg-6">
                                        <label for="name">Email <b title="required" class="text-danger">*</b></label>
                                        <input type="email" name="email" id="email" class="form-control"
                                            value="{{ $setting->email }}">
                                        @error('email')
                                            <p class="text-danger"><b>{{ $message }}</b></p>
                                        @enderror
                                    </div>

                                    <div class="form-group col-lg-6">
                                        <label for="name">Phone <b title="required" class="text-danger">*</b></label>
                                        <input type="text" name="phone" id="phone" class="form-control"
                                            value="{{ $setting->phone }}">
                                        @error('phone')
                                            <p class="text-danger"><b>{{ $message }}</b></p>
                                        @enderror
                                    </div>

                                    <div class="form-group col-lg-6">
                                        <label for="name">Facebook URL <b title="required"
                                                class="text-danger">*</b></label>
                                        <input type="text" name="facebook" id="facebook" class="form-control"
                                            value="{{ $setting->facebook }}">
                                        @error('facebook')
                                            <p class="text-danger"><b>{{ $message }}</b></p>
                                        @enderror
                                    </div>

                                    <div class="form-group col-lg-6">
                                        <label for="name">Twitter Name <b title="required"
                                                class="text-danger">*</b></label>
                                        <input type="text" name="twitter" id="twitter" class="form-control"
                                            value="{{ $setting->twitter }}">
                                        @error('twitter')
                                            <p class="text-danger"><b>{{ $message }}</b></p>
                                        @enderror
                                    </div>

                                    <div class="form-group col-lg-6">
                                        <label for="name">Instagram Name <b title="required"
                                                class="text-danger">*</b></label>
                                        <input type="text" name="instagram" id="instagram" class="form-control"
                                            value="{{ $setting->instagram }}">
                                        @error('instagram')
                                            <p class="text-danger"><b>{{ $message }}</b></p>
                                        @enderror
                                    </div>

                                    <div class="form-group col-lg-6">
                                        <label for="name">Card One <b title="required" class="text-danger">*</b></label>
                                        <textarea name="card1" id="card1" class="summernote">{{ $setting->contact_card_1 }}</textarea>
                                        @error('card1')
                                            <p class="text-danger"><b>{{ $message }}</b></p>
                                        @enderror
                                    </div>

                                    <div class="form-group col-lg-6">
                                        <label for="name">Card Two <b title="required" class="text-danger">*</b></label>
                                        <textarea name="card2" id="card2" class="summernote">{{ $setting->contact_card_2 }}</textarea>
                                        @error('card2')
                                            <p class="text-danger"><b>{{ $message }}</b></p>
                                        @enderror
                                    </div>

                                    <div class="form-group col-lg-6">
                                        <label for="name">Card Three <b title="required"
                                                class="text-danger">*</b></label>
                                        <textarea name="card3" id="car3" class="summernote">{{ $setting->contact_card_3 }}</textarea>
                                        @error('card3')
                                            <p class="text-danger"><b>{{ $message }}</b></p>
                                        @enderror
                                    </div>

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
