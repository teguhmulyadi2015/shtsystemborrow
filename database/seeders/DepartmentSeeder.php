<?php

namespace Database\Seeders;

// use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Department;
use Illuminate\Support\Facades\DB;

class DepartmentSeeder extends Seeder
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
                'dept_code' => '700',
                'dept_name' => 'IT',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'dept_code' => '610',
                'dept_name' => 'ADM',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'dept_code' => '100',
                'dept_name' => 'VP Office',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'dept_code' => '150',
                'dept_name' => 'FTY Office',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'dept_code' => '300',
                'dept_name' => 'Prod Center',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'dept_code' => '310',
                'dept_name' => 'Prod Control',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'dept_code' => '31A',
                'dept_name' => 'Prod Planning',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'dept_code' => '31B',
                'dept_name' => 'FGWH',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'dept_code' => '31C',
                'dept_name' => 'Subcontract',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'dept_code' => '320',
                'dept_name' => 'Stockfitting',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'dept_code' => '330',
                'dept_name' => 'Emboss',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ];

        // Department::create($data);
        DB::table('departments')->insert($data);
    }
}
