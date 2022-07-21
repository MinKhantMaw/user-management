@extends('user.layouts.app')
@section('title','User Export')
@section('content')
<div class="content-wrapper">
        <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h2>CIF Update Information Report</h2>
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
            <form action="{{ route('user.export') }}" method="GET" id="search_form">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="form-group col-md-3 col-sm-3 col-xs-3">
                                From Date
                                <div class="input-group date" id="fromDate">
                                    <?php $from_date = isset($_GET["from_date"])?$_GET["from_date"]:"";?>
                                    <input autocomplete="off" class="form-control datepicker" id="from_date"
                                        name="from_date" placeholder="From Date" type="date" value="{{$from_date}}">
                                </div>
                            </div>
                            <div class="form-group col-md-3 col-sm-3 col-xs-3">
                                To Date
                                <div class="input-group date" id="toDate">
                                    <?php $to_date = isset($_GET["to_date"])?$_GET["to_date"]:"";?>
                                    <input autocomplete="off" class="form-control datepicker" id="to_date"
                                       name="to_date" placeholder="To Date" type="date" value="{{$to_date}}">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-2 mt-2">
                                <button type="submit" class="btn btn-block btn-primary">
                                    <i class="fa fa-search"></i>  Search  ...
                                </button>
                            </div>

                            <div class="col-2 mt-2">
                                <a onclick="Reset()" class="btn btn-block btn-warning">
                                    <i class="fa fa-undo"></i> Reset
                                </a>
                            </div>



                                {{-- @if (count($datas) > 0) --}}
                                <div class="col-2 mt-2">
                                    <button type="submit" name="action" value="cif_update_report" class="btn btn-block btn-success">
                                        Export
                                    </button>
                                </div>
                                {{-- @endif --}}
                        </div>
                    </div>
                </div>
            </form>
        </div> <br>

        {{-- @if (count($datas) > 0)
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="branch" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Change Date</th>
                                        <th>Time</th>
                                        <th>Channel</th>
                                        <th>Customer Name</th>
                                        <th>Cif ID</th>
                                        <th>NRC/Passport</th>
                                        <th>Email</th>
                                        <th>Contact Mobile Number</th>
                                        <th>Gender</th>
                                        <th>Date Of Birth</th>
                                        <th>Father Name</th>
                                        <th>Mother Name</th>
                                        <th>Religion</th>
                                        <th>Alias Name</th>
                                        <th>Division</th>
                                        <th>Township</th>
                                        <th>Ward</th>
                                        <th>Street</th>
                                        <th>House Number</th>
                                        <th>Passport Issue Date</th>
                                        <th>Passport Expiry Date</th>
                                        <th>Passport Country</th>
                                        <th>Previous Info</th>
                                        <th>Update Info</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($datas as $data)
                                    <tr>
                                        <td>{{ ++$i }}</td>
                                        <td>{{$data->updated_at ?? ''}}</td>
                                        <td>{{$data->created_at ?? ''}}</td>
                                        <td>
                                            @if($data->partner_code == 'UabPay')
                                                uabpay
                                            @elseif($data->partner_code == 'UabPay+')
                                                uabpay+
                                            @elseif($data->partner_code == 'SaiSaiPay')
                                                SaiSai Pay
                                            @else
                                                {{$data->partner_code ?? ''}}
                                            @endif
                                        </td>
                                        <td>{{$data->name ?? ''}}</td>
                                        <td>{{$data->customer_code ?? ''}}</td>
                                        <td>{{$data->nrc_no ?? ''}}</td>
                                        <td>{{$data->email ?? ''}}</td>
                                        <td>{{$data->mobile_no ?? ''}}</td>
                                        <td>{{$data->gender ?? ''}}</td>
                                        <td>{{$data->dob ?? ''}}</td>
                                        <td>{{$data->father_name ?? ''}}</td>
                                        <td>{{$data->mother_name ?? ''}}</td>
                                        <td>{{$data->religion ?? ''}}</td>
                                        <td>{{$data->alias_name ?? ''}}</td>
                                        <td>{{$data->division_code ?? ''}}</td>
                                        <td>{{$data->township_code ?? ''}}</td>
                                        <td>{{$data->ward ?? ''}}</td>
                                        <td>{{$data->street ?? ''}}</td>
                                        <td>{{$data->house_no ?? ''}}</td>
                                        <td>{{$data->id_issue_date ?? ''}}</td>
                                        <td>{{$data->passport_expiry_date ?? ''}}</td>
                                        <td>{{$data->passport_country ?? ''}}</td>
                                        <td>{{$data->device_id ?? ''}}</td>
                                        <td>{{$data->session_id ?? ''}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <br>

                    {{$datas->appends(request()->input())->links()}}

                    <!-- /.card-body -->
                </div>
            </div>
        </div>
        @endif --}}
    </section>
</div>

@endsection


{{-- @section('javascript')

<script type ="text/javascript">
    function Reset() {
        window.location.href = "{{URL::to('cif_update_report')}}"
    }

    $(document).ready(function () {
        var fromDate = '<?php echo $from_date?>';
        var toDate = '<?php echo $to_date?>';

        if(fromDate == ''){
            $('#from_date').val(moment(new Date()).format("YYYY-MM-DD"));
        }

        if(toDate == ''){
            $('#to_date').val(moment(new Date()).format("YYYY-MM-DD"));
        }
    });

</script>

@endsection --}}
