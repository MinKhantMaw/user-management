<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Exports\Export;
use App\Exports\UsersExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Redirect;

class ReportController extends Controller
{
    public function export(Request $request)
    {

        $from_date = Carbon::today()->toDateString();
        $to_date = Carbon::today()->toDateString();

        if ($request->input('from_date') != null) {
            $from_date = $request->input('from_date');
        }
        if ($request->input('to_date') != null) {
            $to_date = $request->input('to_date');
        }

        if ($from_date > $to_date) {
            return Redirect::back()->withErrors([
                'msg' => 'To Date should be later than From Date!',
            ]);
        }

        $from_date = $from_date . ' 00:00:00';
        $to_date = $to_date . ' 23:59:59';

        $search = ['from_date' => $from_date, 'to_date' => $to_date];

        $datas = User::select('id', 'name', 'email', 'created_at', 'updated_at')
                    ->where('created_at', '>=', $from_date)
                    ->where('created_at', '<=', $to_date)
                    ->orderBy('id', 'desc')
                    ->paginate(10);

        if ($request->action == 'user-report-export') {
            return $this->ExportUserList($search);
        }
        return view('report.user_report', compact('datas'))->with(
            'i',
            ($request->input('page', 1) - 1) * 15
        );
    }

    public function ExportUserList($search)
    {
        return Excel::download(new UsersExport($search['from_date'], $search['to_date']),'UserReport-' . Carbon::today()->toDateString() . '.xlsx',\Maatwebsite\Excel\Excel::XLSX);
    }
}
