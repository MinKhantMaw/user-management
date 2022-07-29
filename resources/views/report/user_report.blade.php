@extends('user.layouts.app')
@section('title', 'User Report')
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <h2>User Update Information Report</h2>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>

        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <section class="content">
            <div class="container-fluid">
                <form action="{{ route('user-report-export') }}" method="GET" id="search_form">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="form-group col-md-3 col-sm-3 col-xs-3">
                                    From Date
                                    <div class="input-group date" id="fromDate">
                                        <?php $from_date = isset($_GET['from_date']) ? $_GET['from_date'] : ''; ?>
                                        <input autocomplete="off" class="form-control datepicker" id="from_date"
                                            name="from_date" placeholder="From Date" type="date"
                                            value="{{ $from_date }}">
                                    </div>
                                </div>
                                <div class="form-group col-md-3 col-sm-3 col-xs-3">
                                    To Date
                                    <div class="input-group date" id="toDate">
                                        <?php $to_date = isset($_GET['to_date']) ? $_GET['to_date'] : ''; ?>
                                        <input autocomplete="off" class="form-control datepicker" id="to_date"
                                            name="to_date" placeholder="To Date" type="date" value="{{ $to_date }}">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-2 mb-2">
                                    <button type="submit" class="btn btn-block btn-primary">
                                        <i class="fa fa-search"></i> Search ...
                                    </button>
                                </div>

                                <div class="col-2 mb-2">
                                    <a onclick="Reset()" class="btn btn-block btn-warning">
                                        <i class="fa fa-undo"></i> Reset
                                    </a>
                                </div>

                                @if (count($datas) > 0)
                                    <div class="col-2 mb-2">
                                        <button type="submit" name="action" value="user-report-export"
                                            class="btn btn-block btn-success">
                                            <i class="fa fa-download"></i> Export
                                        </button>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <br>
            @if (count($datas) > 0)
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="branch" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Created Date</th>
                                                <th>Updated Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($datas as $data)
                                                <tr>
                                                    <td>{{ ++$i }}</td>

                                                    <td>{{ $data->name ?? '' }}</td>
                                                    <td>{{ $data->email ?? '' }}</td>
                                                    <td>{{ $data->updated_at ?? '' }}</td>
                                                    <td>{{ $data->created_at ?? '' }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <br>

                            {{ $datas->appends(request()->input())->links() }}

                            <!-- /.card-body -->
                        </div>
                    </div>
                </div>
            @endif
        </section>
    </div>

@endsection
@section('scripts')
    <script type="text/javascript">
        function Reset() {
            window.location.href = "{{ URL::to('user-report-export') }}"
        }

        $(document).ready(function() {
            var fromDate = '<?php echo $from_date; ?>';
            var toDate = '<?php echo $to_date; ?>';

            if (fromDate == '') {
                $('#from_date').val(moment(new Date()).format("YYYY-MM-DD"));
            }

            if (toDate == '') {
                $('#to_date').val(moment(new Date()).format("YYYY-MM-DD"));
            }
        });
    </script>

@endsection
