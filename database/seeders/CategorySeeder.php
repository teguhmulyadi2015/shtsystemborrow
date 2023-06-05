<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
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
                'id' => 1,
                'category_name' => 'Flashdisk',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 2,
                'category_name' => 'Laptop',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 3,
                'category_name' => 'Pointer',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 4,
                'category_name' => 'Speaker',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 5,
                'category_name' => 'Headphone',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 6,
                'category_name' => 'Audio Input',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ];

        Category::insert($data);
    }
}
