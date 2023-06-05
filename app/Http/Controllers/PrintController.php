<?php

namespace App\Http\Controllers;

use App\Exports\PrintExport;
use App\Models\Employee;
use App\Models\Printt;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;




use Illuminate\Http\Request;

class PrintController extends Controller
{
    protected $trno;
    public function __construct()
    {
        //trno generate
        $today = date('Y-m-d');
        $getMaxCount = Printt::where(DB::raw('DATE(date_print)'), '=', $today)->count('*');
        $getMaxCount = $getMaxCount + 1;
        // dd($getMaxCount);

        $getDate = date('mdy');
        $this->trno = "JPI" . $getDate . $getMaxCount; //SBI-date-maxNumberByToday+1
        // dd($this->trno);
    }
    public function index()
    {
        $print = Printt::join('employees', 'prints.employee_id', '=', 'employees.employee_id')
            ->join('departments', 'employees.dept_id', '=', 'departments.dept_code')->orderBy('prints.trno', 'desc')
            // ->get(['prints.*', 'employees.employee_name', 'departments.dept_name'])
            ->paginate(10);
        // dd($print);
        return view('print.v_index', compact('print'));
    }

    public function add()
    {
        return view('print.v_create');
    }

    public function store(Request $request)
    {
        // validasi form
        $request->validate([
            'nik' => 'required',
            // 'fullname' => 'required',
            // 'dept' => 'required',
            'colorbw' => 'required',
            'kertas' => 'required|in:KS,KI',
            'sheetsQty' => 'required',
            // 'return_date_plan' => 'required'
        ]);
        // cek nik di db
        $cekNIK = Employee::where('employee_id', '=', $request->input('nik'))->first();

        if (!$cekNIK) {
            return redirect()->to(route('print.add'))->withInput()->with('fail', 'ID ' . $request->input('nik') . ' Not registered!!');
        }


        // menampung data inputan kedalam array data
        $data = [
            'trno' => $this->trno,
            'employee_id' => $request->input('nik'),
            'colorbw' => $request->input('colorbw'),
            'sheets' => $request->input('kertas'),
            'sheets_qty' => $request->input('sheetsQty'),
            'date_print' => date('Y-m-d')
        ];

        //insert into table borrows
        $print = Printt::create($data);

        if ($print == true) {
            return redirect()->to(route('print.index'))->with('success', 'Done with succes! ');
        } else {
            return redirect()->to(route('print.index'))->with('fail', 'Error , please check! ');
        }
    }



    public function downloadReportPrint(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        // return Excel::download(new HistoryExport, 'reportHistory.xlsx');

        return Excel::download(new PrintExport($startDate, $endDate), 'reportPrint.xlsx');
    }




    public function search(Request $request)
    {
        $search = $request->input('search');
        if (!empty($search)) {
            $print = Printt::join('employees', 'prints.employee_id', '=', 'employees.employee_id')
                ->join('departments', 'employees.dept_id', '=', 'departments.dept_code')
                ->whereRaw("(prints.trno LIKE ? OR prints.employee_id LIKE ?)", ["%{$search}%", "%{$search}%"])
                ->orderBy('prints.trno', 'desc')
                ->paginate(10);
        } else {
            return $this->index();
        }
        // dd($history);

        return view('print.v_index_search', compact('print'));
    }
}
