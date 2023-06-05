<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Borrow extends Model
{
    use HasFactory;
    // protected $fillable = ['empployee_id', 'asset_id', 'date_borrow', 'date_return'];
    protected $guarded = [];
    public $timestamps = true;
    // protected $createdAt = 'created_at';
    // protected $updatedAt = 'updated_at';



    // public function getAllBorrow($search)
    // {
    //     return $this->join('assets', 'borrows.asset_id', '=', 'assets.asset_code')
    //         ->join('employees', 'borrows.employee_id_borrow', '=', 'employees.employee_id')
    //         ->join('departments', 'employees.dept_id', '=', 'departments.dept_code')
    //         ->select('borrows.id', 'borrows.employee_id_borrow', 'borrows.asset_id', 'assets.asset_name', 'borrows.date_borrow', 'borrows.date_return', 'employees.employee_name', 'departments.dept_name')
    //         ->where('assets.status', '=', 0)
    //         ->orWhere('borrows.employee_id_borrow', 'like', "%$search%")
    //         ->orWhere('borrows.asset_id', 'like', "%$search%")
    //         ->paginate(10);
    // }

}
