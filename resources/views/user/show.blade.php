@extends('user.layouts.app')
@section('title','Show User')
@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1 class="m-0 text-dark">Show User</h1>
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
                    <div class="m-2">
                        <a href="{{ route('user.index') }}" class="btn btn-sm btn-dark">Back</a>
                    </div>
                       <div class="card mt-2">

                            <div class="card-header">
                                <p>User Details</p>
                            </div>
                            <div class="card-body">
                                <div class="">
                                    <div class="form-group">
                                        <label for="">Name :: {{ $show_user->name }}</label>

                                    </div>
                                    <div class="form-group">
                                        <label for="">Email :: {{ $show_user->email }}</label>
                                    </div>
                                    <div class="form-group">
                                       <label for="">Permission:: {{ $show_user->rolename }}</label>
                                    </div>
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
