@extends('user.layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
               <div class="card mt-3">
                    <div class="card-header">

                    </div>
                    <div class="card-body">
                        <table id="example" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Created Date</th>
                                   <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                               @foreach ($user as $list)
                               <tr>
                                <td>{{ $list->id }}</td>
                                <td>{{ $list->name }}</td>
                                <td>{{ $list->email }}</td>
                                <td>{{ $list->created_at }}</td>
                                <td>
                                    <a href="{{ route('user.destroy',$list->id) }}" class="btn btn-sm btn-danger">Delete</a>
                                </td>
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

@section('scripts')
    <script>
            $(document).ready(function () {
                 $('#example').DataTable();

         });
    </script>

@endsection
