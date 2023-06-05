<?php

namespace App\Exports;

use App\Models\Borrow;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Carbon;




class HistoryExport implements FromCollection, WithHeadings
{

    /**
     * @return \Illuminate\Support\Collection
     */

    public function headings(): array
    {
        return [
            'NIK',
            'Name',
            'Dept',
            'Asset Code',
            'Asset Name',
            'Date Borrow',
            'NIK Return',
            'Name',
            'Dept',
            'Actual Date Return'
        ];
    }


    protected $startDate;
    protected $endDate;

    public function __construct($startDate, $endDate)
    {
        $this->startDate = Carbon::parse($startDate)->startOfDay();
        $this->endDate = Carbon::parse($endDate)->endOfDay();
    }

    public function collection()
    {
        // return DB::table('borrows')
        //     ->join('assets', 'borrows.asset_id', '=', 'assets.asset_code')
        //     ->join('employees', 'borrows.employee_id_borrow', '=', 'employees.employee_id')
        //     ->join('departments', 'employees.dept_id', '=', 'departments.dept_code')
        //     ->select('borrows.employee_id_borrow', 'employees.employee_name', 'departments.dept_name', 'borrows.asset_id', 'assets.asset_name', 'borrows.date_borrow', 'borrows.date_return_plan', 'borrows.employee_id_return', 'borrows.date_return')
        //     ->where('borrows.employee_id_return', '!=', NULL)
        //     ->where('borrows.date_return', '!=', NULL)
        //     ->whereBetween('date_return', [$this->startDate, $this->endDate])->get();


        return DB::table('borrows')
            ->join('assets', 'borrows.asset_id', '=', 'assets.asset_code')
            ->join('employees as be', 'borrows.employee_id_borrow', '=', 'be.employee_id')
            ->join('employees as br', 'borrows.employee_id_return', '=', 'br.employee_id')
            ->join('departments as de', 'be.dept_id', '=', 'de.dept_code')
            ->join('departments as dr', 'br.dept_id', '=', 'dr.dept_code')
            ->select(
                'borrows.employee_id_borrow',
                'be.employee_name as be_empname',
                'de.dept_name as de_dept_name',
                'borrows.asset_id',
                'assets.asset_name',
                'borrows.date_borrow',
                'borrows.employee_id_return',
                'br.employee_name as br_empname',
                'dr.dept_name as dr_dept_name',
                'borrows.date_return'
            )
            ->where('borrows.employee_id_return', '!=', NULL)
            ->where('borrows.date_return', '!=', NULL)
            ->orderBy('borrows.id', 'asc')
            ->whereBetween('date_return', [$this->startDate, $this->endDate])->get();
    }
}
