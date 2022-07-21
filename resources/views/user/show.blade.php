@extends('user.layouts.app')
@section('title','Show User')
@section('content')
    <div class="container">
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

                            </div>
                        </div>
                   </div>
            </div>
        </div>
    </div>

@endsection
