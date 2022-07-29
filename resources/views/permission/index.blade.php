@extends('user.layouts.app')
@section('title', 'Permission')
@section('permission','active')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1 class="m-0 text-dark">Permission Management</h1>
              </div><!-- /.col -->
            </div><!-- /.row -->
          </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
        <!-- Main content -->
        <section class="content">
          <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-md-12">
                    @if ($message=Session::get('success'))
                        <div class="alert alert-success alert-block">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <p>{{ $message }}</p>
                        </div>
                    @endif
                    <div class="card mb-2">
                        <div class="card-header">
                            <a href="{{ route('permission.create') }}" class="btn btn-sm btn-success">Create New Permission</a>
                        </div>
                        <div class="card-body ">
                            @if (isset($permissions))
                                <table id="branch" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($permissions as $permission)
                                            <tr>
                                                <td>{{ ++$i }}</td>
                                                <td>{{ $permission->name }}</td>
                                                <td>
                                                    <a href="{{ route('permission.show',$permission->id) }}" class="btn btn-info">Show</a>
                                                    <a href="{{ route('permission.edit',$permission->id) }}" class="btn btn-primary">Edit</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @endif
                           <div class="mt-2">
                            {{ $permissions->links() }}
                           </div>
                        </div>
                    </div>
                </div>
              <!-- ./col -->
            </div>
            <!-- /.row -->
            <!-- Main row -->
            <!-- /.row (main row) -->
          </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>

@endsection
