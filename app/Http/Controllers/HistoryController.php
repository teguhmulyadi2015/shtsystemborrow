<?php

namespace App\Http\Controllers;

use App\Exports\HistoryExport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;


class HistoryController extends Controller
{
    public function index()
    {
        // $search = '10162';
        $history = DB::table('borrows')
            ->join('assets', 'borrows.asset_id', '=', 'assets.asset_code')
            ->join('employees as be', 'borrows.employee_id_borrow', '=', 'be.employee_id')
            ->join('employees as br', 'borrows.employee_id_return', '=', 'br.employee_id')
            ->join('departments as de', 'be.dept_id', '=', 'de.dept_code')
            ->join('departments as dr', 'br.dept_id', '=', 'dr.dept_code')
            ->select('borrows.trno', 'borrows.id', 'borrows.employee_id_borrow', 'borrows.asset_id', 'assets.asset_name', 'borrows.date_borrow', 'borrows.date_return', 'be.employee_name as be_empname', 'br.employee_name as br_empname', 'de.dept_name as de_dept_name', 'dr.dept_name as dr_dept_name', 'borrows.date_return_plan', 'borrows.employee_id_return')
            ->where('borrows.employee_id_return', '!=', NULL)
            ->where('borrows.date_return', '!=', NULL)
            ->orderBy('borrows.id', 'desc')
            ->paginate(10);


        // dd($return);
        return view('history.v_index', ['history' => $history]);
    }


    public function downloadReportHistory(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        // return Excel::download(new HistoryExport, 'reportHistory.xlsx');

        return Excel::download(new HistoryExport($startDate, $endDate), 'reportHistory.xlsx');
    }

    public function searchHistory(Request $request)
    {
        $search = $request->input('search');
        if (!empty($search)) {
            $history = DB::table('borrows')
                ->join('assets', 'borrows.asset_id', '=', 'assets.asset_code')
                ->join('employees', 'borrows.employee_id_borrow', '=', 'employees.employee_id')
                ->join('departments', 'employees.dept_id', '=', 'departments.dept_code')
                ->select('borrows.trno', 'borrows.id', 'borrows.employee_id_borrow', 'borrows.asset_id', 'assets.asset_name', 'borrows.date_borrow', 'borrows.date_return', 'employees.employee_name', 'departments.dept_name', 'borrows.date_return_plan', 'borrows.employee_id_return')
                ->where('borrows.employee_id_return', '!=', NULL)
                ->where('borrows.date_return', '!=', NULL)
                ->whereRaw("(borrows.trno LIKE ? OR borrows.employee_id_borrow LIKE ? OR employees.employee_name LIKE ? OR borrows.asset_id LIKE ?)", ["%{$search}%", "%{$search}%", "%{$search}%", "%{$search}%"])
                ->orderBy('borrows.id', 'desc')
                ->paginate(10);
        } else {
            return $this->index();
        }
        // dd($history);

        return view('history.v_index_search', compact('history'));
    }
}
