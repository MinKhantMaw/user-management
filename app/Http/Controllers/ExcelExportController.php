<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Exports\Export;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Redirect;

class ExcelExportController extends Controller
{


    // public function excelExport(Request $request)
    // {
    //     $authUser = Auth::id();
    //     // $from_date = $request->input('from_date');
    //     // $to_date = $request->input('to_date');

    //     $from_date = Carbon::today()->toDateString();
    //     $to_date = Carbon::today()->toDateString();

    //     if ($request->input('from_date') != null) {
    //         $from_date = $request->input('from_date');
    //     }
    //     if ($request->input('to_date') != null) {
    //         $to_date = $request->input('to_date');
    //     }

    //     if($from_date > $to_date){
    //         return Redirect::back()->withErrors(['msg' => 'To Date should be later than From Date!']);
    //     }

    //     $search = ['from_date' => $from_date, 'to_date' => $to_date];

    //     if($request->action == 'cif_update_report'){
    //         return $this->export($search);
    //     }




    //     return view('user.excel-report');
    // }

    // public function export()
    // {
    //   return Excel::download(new Export,'user.xlsx');
    // //    return Excel::download(new Export($search['from_date'], $search['to_date']),  'UserAdminReport-'. Carbon::today()->toDateString() . '.xlsx', \Maatwebsite\Excel\Excel::XLSX);

    // }
}
