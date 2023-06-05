<?php

namespace App\Http\Controllers;

use App\Mail\ContactForm;
use Illuminate\Http\Request;
use App\Models\Borrow;
use App\Models\Email;
use App\Models\Employee;
use App\Notifications\ReturnNotification;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;



class HomeController extends Controller
{
    public function index()
    {
        // $search = '10162';
        $borrow = DB::table('borrows')
            ->join('assets', 'borrows.asset_id', '=', 'assets.asset_code')
            ->join('employees', 'borrows.employee_id_borrow', '=', 'employees.employee_id')
            ->join('departments', 'employees.dept_id', '=', 'departments.dept_code')
            ->select('borrows.trno', 'borrows.id', 'borrows.employee_id_borrow', 'borrows.asset_id', 'assets.asset_name', 'borrows.date_borrow', 'borrows.date_return', 'employees.employee_name', 'departments.dept_name', 'borrows.date_return_plan')
            ->where('assets.status', '=', 0)
            ->where('borrows.employee_id_return', '=', NULL)
            ->where('borrows.date_return', '=', NULL)
            ->orderBy('borrows.id', 'desc')->paginate(10);
        // dd($borrow);


        // $lateReturn = Borrow::where('employee_id_return', '=', NULL)
        //     ->where('date_return', '=', NULL)->get();


        // $lateReturn = Borrow::join('employees', 'borrows.employee_id_borrow', '=', 'employees.employee_id')
        //     ->where('borrows.employee_id_return', '=', NULL)
        //     ->where('borrows.date_return', '=', NULL)->get(['employees.employee_name', 'borrows.asset_id', 'borrows.date_return_plan', 'borrows.employee_id_borrow']);

        // foreach ($lateReturn as $d) { //looping all data borrow status not yet return
        //     $today = date('Y-m-d');

        //     // dd($d->date_return_plan, ' ', $today);
        //     if ($d->date_return_plan < $today) { //if found data late, do this step and send email
        //         $data = [
        //             'employee_name' => $d->employee_name,
        //             'asset_id' => $d->asset_id,
        //             'date_return_plan' => $d->date_return_plan
        //         ];

        //         $email = Email::where('employee_id', '=', $d->employee_id_borrow)->get(); //looking for email that have late return asset

        //         foreach ($email as $e) {
        //             $e->email;
        //             Mail::to([$e->email])->cc(['syifa.dwi@sht.ssbshoes.com', 'teguh.mulyadi@sht.ssbshoes.com'])->send(new ContactForm($data));
        //         }
        //     }
        // }

        return view('home.v_index', ['borrow' => $borrow]);
    }

    public function search(Request $request)
    {
        $search = $request->input('search');
        if (!empty($search)) {
            $borrow = DB::table('borrows')
                ->join('assets', 'borrows.asset_id', '=', 'assets.asset_code')
                ->join('employees', 'borrows.employee_id_borrow', '=', 'employees.employee_id')
                ->join('departments', 'employees.dept_id', '=', 'departments.dept_code')
                ->select('borrows.trno', 'borrows.id', 'borrows.employee_id_borrow', 'borrows.asset_id', 'assets.asset_name', 'borrows.date_borrow', 'borrows.date_return', 'employees.employee_name', 'departments.dept_name', 'borrows.date_return_plan')
                ->where('assets.status', '=', '0')
                ->where('borrows.employee_id_return', '=', NULL)
                ->where('borrows.date_return', '=', NULL)
                ->whereRaw("(borrows.trno LIKE ? OR borrows.employee_id_borrow LIKE ? OR employees.employee_name LIKE ? OR borrows.asset_id LIKE ?)", ["%{$search}%", "%{$search}%", "%{$search}%", "%{$search}%"])
                ->orderBy('borrows.id', 'desc')->paginate(10);
        } else {
            $borrow = DB::table('borrows')
                ->join('assets', 'borrows.asset_id', '=', 'assets.asset_code')
                ->join('employees', 'borrows.employee_id_borrow', '=', 'employees.employee_id')
                ->join('departments', 'employees.dept_id', '=', 'departments.dept_code')
                ->select('borrows.trno', 'borrows.id', 'borrows.employee_id_borrow', 'borrows.asset_id', 'assets.asset_name', 'borrows.date_borrow', 'borrows.date_return', 'employees.employee_name', 'departments.dept_name', 'borrows.date_return_plan')
                ->where('assets.status', '=', 0)
                ->where('borrows.employee_id_return', '=', NULL)
                ->where('borrows.date_return', '=', NULL)
                ->orderBy('borrows.id', 'desc')->paginate(10);
        }

        return view('home.v_index_search', ['borrow' => $borrow]);
    }
}
