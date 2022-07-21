@extends('user.layouts.app')
@section('title','Home Page')
@section('content')
    {{-- start modal --}}
        <!-- Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form action="{{  url('/delete') }}" method="POST">
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
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @if (Session::has('success'))
                  <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                      <strong>{{ Session::get('success') }}</strong>
                      <button type="button" class="btn-close btn btn-sm" data-bs-dismiss="alert"
                          aria-label="Close"></button>
                  </div>
               @endif
               <div class="d-flex mt-3 justify-content-between">
                    <div class="">
                        @can('write post')
                                <a href="{{ route('user.create')}}" class="btn btn-primary ">Create New User</a>
                        @endcan
                    </div>
                    {{-- <div class="">
                        <a href="{{ route('user.datatable') }}" class="btn btn-secondary">Datatable</a>
                    </div> --}}
                    <div class="">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-outline-danger">Logout</button>
                        </form>
                    </div>
                </div>

                <div class="card mt-2">
                        <div class="card-header">
                           <div class="d-flex justify-content-between">
                                <div class="">
                                    <p>User List</p>
                                    <span>User Name:: <b class="text-capitalize">{{ Auth::user()->name }}</b></span>
                                </div>
                                <form action="{{ route('user.search') }}" method="GET" id="search_form">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="row ms-3">
                                                <div class="d-flex">
                                                    <div class="input-group input-group-sm mt-1 ml-3 mb-3" >
                                                        <?php $search_data = isset($_GET["search_data"])?$_GET["search_data"]:"";?>
                                                        <input type="text" name="search_data" value="{{ $search_data }}" class="form-control "
                                                            placeholder="Enter Account Number">
                                                        <div class="">
                                                            <button type="submit" class="btn btn-sm ml-3  btn-primary">
                                                                <i class="fa fa-search"></i>  Search
                                                            </button>
                                                        </div>

                                                        <div class="">
                                                            <a onclick="Reset()" class="btn btn-sm ml-3 btn-warning">
                                                                <i class="fa fa-undo"></i> Reset
                                                            </a>
                                                        </div>
                                                       <div class="">
                                                            <button type="submit" name="action" value="user.search" class="btn btn-sm ml-3  btn-success">
                                                                <i class="fa fa-download"></i>  Export
                                                            </button>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
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
                                <td>{{ $list->id }}</td>
                                <td>{{$list->name}}</td>
                                <td>{{$list->email}}</td>
                                <td>{{ $list->created_at->format('d-m-y') }}</td>
                                <td>
                                    <a href="{{ route('user.show',$list->id) }}" class="btn btn-sm btn-info">Show</a>
                                    @can('edit post')
                                    <a href="{{ route('user.edit',$list->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                    @endcan

                                    {{-- <a href="{{ url('/delete',$list->id) }}" class="btn btn-sm btn-danger">Delete</a>--}}

                                    @can('delete post')
                                    <button type="button" class="btn btn-sm btn-danger delete" value="{{ $list->id }}">Delete</button>
                                    @endcan

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
        $(document).ready(function(){
            $(".delete").click(function(e){
               e.preventDefault();
               var user_id=$(this).val();
               $("#user_id").val(user_id);
               $("#deleteModal").modal('show')
            })

        })
        function Reset(){
            Window.location={{ URL::TO('user_search') }}
        }
    </script>
@endsection
