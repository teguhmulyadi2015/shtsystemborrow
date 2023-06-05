<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'employee_id' => '10162',
                'employee_name' => 'Teguh Mulyadi',
                'dept_id' => '700',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'employee_id' => '10161',
                'employee_name' => 'Syifa Dwi',
                'dept_id' => '700',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'employee_id' => '10123',
                'employee_name' => 'Reza Satria',
                'dept_id' => '700',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'employee_id' => '10000',
                'employee_name' => 'Test',
                'dept_id' => '610',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'employee_id' => '11035',
                'employee_name' => 'Tri Wahyu',
                'dept_id' => '700',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ];

        DB::table('employees')->insert($data);
    }
}
