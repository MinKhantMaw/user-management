@extends('user.layouts.app')
@section('title','Create New User')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @if ($errors->any())
                 <div class="alert alert-danger mt-3">
                   <ul>
                     @foreach ($errors->all() as $error)
                         <li>{{ $error }}</li>
                     @endforeach
                    </ul>
                 </div>
                @endif
                <form action="{{ route('user.store') }}" method="POST">
                    @csrf
                   <div class="card mt-2">
                        <div class="card-header">
                            <p>Create New User</p>
                        </div>
                        <div class="card-body">
                            <div class="">
                                <div class="form-group">
                                    <label for="">Name</label>
                                    <input type="text" name="name" class="form-control" placeholder="Enter Name">
                                </div>
                                <div class="form-group">
                                    <label for="">Email</label>
                                    <input type="email" name="email" class="form-control" placeholder="Enter Email">
                                </div>
                                <div class="form-group">
                                    <label for="">Pasword</label>
                                    <input type="password" name="password" class="form-control" placeholder="Enter Password">
                                </div>
                                <div class="form-group">
                                    <label for="">Confirm Password</label>
                                    <input type="password" name="confirm_password" class="form-control" placeholder="Confirm Password">
                                </div>
                                <div class="form-group">
                                    <input type="submit" class="btn btn-primary mt-1" value="Create">
                                </div>
                            </div>
                        </div>
                   </div>
                </form>
            </div>
        </div>
    </div>

@endsection
