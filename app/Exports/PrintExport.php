<?php

namespace App\Exports;

use App\Models\Printt;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class PrintExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */

    public function headings(): array
    {
        return [
            'trno',
            'NIK',
            'Name',
            'Dept',
            'Color/BW',
            'Sheets',
            'Sheet Qty',
            'Date Print'
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
        return DB::table('prints')
            ->join('employees', 'prints.employee_id', '=', 'employees.employee_id')
            ->join('departments', 'departments.dept_code', '=', 'employees.dept_id')
            ->select('prints.trno', 'prints.employee_id', 'employees.employee_name', 'departments.dept_code', 'prints.colorbw', 'prints.sheets', 'prints.sheets_qty', 'prints.date_print')
            ->orderBy('prints.trno', 'desc')
            ->whereBetween('prints.date_print', [$this->startDate, $this->endDate])->get();
    }
}
