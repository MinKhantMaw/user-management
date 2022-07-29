@extends('user.layouts.app')
@section('title', 'Home Page')
@section('user', 'active')
@section('content')
    {{-- start modal --}}
    <!-- Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ url('/delete') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Delete User</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="user_delete_id" id="user_id">
                        <h5>Are you sure you want to delete?</h5>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger btn-sm">Yes,Delete it...!</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- end modal --}}
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row ">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">User Management</h1>
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
                        @if (Session::has('success'))
                            <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                                <strong>{{ Session::get('success') }}</strong>
                                <button type="button" class="btn-close btn btn-sm" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif

                        <div class="card mb-2">
                            <div class="card-header">
                                <div class="d-flex justify-content-between">
                                    @can('ho-user-create')
                                        <a href="{{ route('user.create') }}" class="btn btn-success btn-sm ">Create New User</a>
                                    @endcan
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
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($user as $list)
                                            <tr>
                                                <td>{{ ++$i }}</td>
                                                <td>{{ $list->name }}</td>
                                                <td>{{ $list->email }}</td>
                                                <td>{{ $list->created_at }}</td>
                                                <td>

                                                    <a href="{{ route('user.show', $list->id) }}"
                                                        class="btn btn-sm btn-info">Show</a>

                                                    @can('ho-user-edit')
                                                        <a href="{{ route('user.edit', $list->id) }}"
                                                            class="btn btn-sm btn-warning">Edit</a>
                                                    @endcan
                                                    {{-- <a href="{{ url('/delete',$list->id) }}" class="btn btn-sm btn-danger">Delete</a> --}}
                                                    @can('ho-user-delete')
                                                        <button type="button" class="btn btn-sm btn-danger delete"
                                                            value="{{ $list->id }}">Delete</button>
                                                    @endcan

                                                </td>

                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            {{ $user->links() }}
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
    {{-- <div class="container">
        <div class="row">

        </div>
    </div> --}}

@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $(".delete").click(function(e) {
                e.preventDefault();
                var user_id = $(this).val();
                $("#user_id").val(user_id);
                $("#deleteModal").modal('show')
            })

        })
        // function Reset(){
        //     Window.location={{ URL::TO('user_search') }}
        // }
    </script>
@endsection
