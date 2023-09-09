@extends('admin.layouts.app')

@section('content')
    <style>
        .table td,
        .table th {
            vertical-align: middle;
        }
    </style>
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Pages / List</h1>
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
                <div class="col-12">

                    @if (Session::has('type'))
                        <div class="alert alert-{{ Session::get('type') }}">
                            <strong>{{ Session::get('message') }}</strong>
                        </div>
                    @endif

                    <div class="card">
                        <div class="card-header">
                            <a href="{{ route('pages.create') }}" class="btn btn-primary btn"><i class="fas fa-plus"></i>
                                Create</a>
                            <div class="card-tools">
                                <form action="" method="GET">
                                    <div class="input-group input-group" style="width: 250px;">
                                        <input type="text" class="form-control float-right" placeholder="Search"
                                            name="search" value="{{ Request::get('search') }}">
                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn-default">
                                                <i class="fas fa-search"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-nowrap table-striped">
                                <thead>
                                    <tr>
                                        <th width="50">ID</th>
                                        <th>Page Name</th>
                                        <th>Image</th>
                                        <th width="100">Created Date</th>
                                        <th width="100">Status</th>
                                        <th width="100">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($data) > 0)
                                        @foreach ($data as $item)
                                            <tr>
                                                <td>{{ $item->id }}</td>
                                                <td>{{ $item->name }}</td>
                                                <td><img src="{{ asset('/uploads/pages/thumb/small') }}/{{ $item->image }}"
                                                        height="50px;"></td>
                                                <td>{{ date('d-m-Y', strtotime($item->created_at)) }} </td>
                                                <td>
                                                    @if ($item->status == 1)
                                                        <span class="badge badge-primary">Active</span>
                                                    @else
                                                        <span class="badge badge-danger">In-Active</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{ route('pages.edit', $item->id) }}"
                                                        class="btn btn-sm btn-success"><i class="fas fa-edit"></i></a>
                                                    <form action="{{ route('pages.delete', $item->id) }}" method="POST"
                                                        style="display: contents;">
                                                        @csrf
                                                        @method('delete')
                                                        <button type="submit"
                                                            onclick="return confirmBox({{ $item->id }})"
                                                            class="btn btn-sm btn-danger"><i
                                                                class="fas fa-trash"></i></button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="6" class="text-center">No Record Found</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer clearfix">
                            <ul class="pagination pagination-sm m-0 float-right">
                                @if (!empty($services))
                                    {{ $services->links('pagination::bootstrap-4') }}
                                @endif
                            </ul>
                        </div>
                    </div>
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
    <script>
        function confirmBox(id) {
            let check = confirm("You want to delete this record ?")
            if (check) {
                return true;
            }
            return false;
        }
    </script>
@endsection
