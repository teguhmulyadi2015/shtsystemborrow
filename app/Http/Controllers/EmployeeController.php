<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function getDataByNik(Request $request)
    {
        $nik = $request->input('nik');
        $data = Employee::join('departments', 'employees.dept_id', '=', 'departments.dept_code')->where('employees.employee_id', '=', $nik)->first();
        return response()->json($data);
    }
}
