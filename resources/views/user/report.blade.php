@extends('user.layouts.app')
@section('title','Search User')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card mt-5">
                    <div class="card-header">
                       <div class="d-flex justify-content-between">
                            <form action="{{ route('user.search') }}" method="GET">
                                <button type="submit" value="{{ $search_data }}" name="action" value="user.export" class="btn btn-sm btn-success">Export User</button>
                            </form>
                             <a href="{{ route('user.index') }}" class="btn btn-sm btn-secondary"> Back </a>
                       </div>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                              <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Created Date</th>
                              </tr>
                            </thead>
                            <tbody>
                                @foreach ($search_user as $user)
                                <tr>
                                    <th scope="row">{{ $user->id }}</th>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->created_at->format('d-m-y') }}</td>
                                  </tr>
                                @endforeach
                            </tbody>
                          </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
