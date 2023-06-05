<?php

namespace Database\Seeders;

use App\Models\Asset;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AssetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            //flashdisk
            [
                'asset_code' => 'F01',
                'asset_name' => 'Flashdisk Kingston 16GB',
                'status' => 1, //1 true, it means asset no borrow
                'category_id' => 1, //1 is category id for storage 
                'created_at' => now(),
                'updated_at' => now()

            ],
            [
                'asset_code' => 'F02',
                'asset_name' => 'Toshiba Kingston 32GB',
                'status' => 1, //1 true, it means asset no borrow
                'category_id' => 1, //1 is category id for storage 
                'created_at' => now(),
                'updated_at' => now()

            ],

            // laptop
            [
                'asset_code' => '701002',
                'asset_name' => 'HP Probook 430 G6 I3.3',
                'status' => 1, //1 true, it means asset no borrow
                'category_id' => 2, //1 is category id for laptop 
                'created_at' => now(),
                'updated_at' => now()

            ],
            [
                'asset_code' => '701005',
                'asset_name' => 'HP PROBOOK 430 G3',
                'status' => 1, //1 true, it means asset no borrow
                'category_id' => 2, //1 is category id for laptop 
                'created_at' => now(),
                'updated_at' => now()

            ],
            [
                'asset_code' => '701012',
                'asset_name' => 'HP ProBook 440 G8',
                'status' => 1, //1 true, it means asset no borrow
                'category_id' => 2, //1 is category id for laptop 
                'created_at' => now(),
                'updated_at' => now()

            ],
            [
                'asset_code' => '701019',
                'asset_name' => 'HP PROBOOK 430 G3 P7Q52PA',
                'status' => 1, //1 true, it means asset no borrow
                'category_id' => 2, //1 is category id for laptop 
                'created_at' => now(),
                'updated_at' => now()

            ],

            // pointer
            [
                'asset_code' => '725002',
                'asset_name' => 'Logitech R800',
                'status' => 1, //1 true, it means asset no borrow
                'category_id' => 3, //1 is category id for pointer 
                'created_at' => now(),
                'updated_at' => now()

            ],
            [
                'asset_code' => '725003',
                'asset_name' => 'Logitech R800',
                'status' => 1, //1 true, it means asset no borrow
                'category_id' => 3, //1 is category id for pointer 
                'created_at' => now(),
                'updated_at' => now()

            ],

            // speaker jabra

            [
                'asset_code' => '725004',
                'asset_name' => 'Speaker Jabra 510',
                'status' => 1, //1 true, it means asset no borrow
                'category_id' => 4, //1 is category id for speaker jabra 
                'created_at' => now(),
                'updated_at' => now()

            ],
            [
                'asset_code' => '725005',
                'asset_name' => 'Speaker Jabra 750',
                'status' => 1, //1 true, it means asset no borrow
                'category_id' => 4, //1 is category id for speaker jabra 
                'created_at' => now(),
                'updated_at' => now()

            ],
            [
                'asset_code' => '725006',
                'asset_name' => 'Speaker Jabra 750',
                'status' => 1, //1 true, it means asset no borrow
                'category_id' => 4, //1 is category id for speaker jabra 
                'created_at' => now(),
                'updated_at' => now()

            ],

            // headphone
            [
                'asset_code' => 'H01',
                'asset_name' => 'Headphone NYK HS-M01 1',
                'status' => 1, //1 true, it means asset no borrow
                'category_id' => 5, //1 is category id for speaker jabra 
                'created_at' => now(),
                'updated_at' => now()

            ],
            [
                'asset_code' => 'H02',
                'asset_name' => 'Headphone NYK HS-M01 2',
                'status' => 1, //1 true, it means asset no borrow
                'category_id' => 5, //1 is category id for speaker jabra 
                'created_at' => now(),
                'updated_at' => now()

            ],
            [
                'asset_code' => 'H03',
                'asset_name' => 'Headphone NYK HS-M01 3',
                'status' => 1, //1 true, it means asset no borrow
                'category_id' => 5, //1 is category id for speaker jabra 
                'created_at' => now(),
                'updated_at' => now()

            ],

            //saramonic
            [
                'asset_code' => 'S01',
                'asset_name' => 'Saramonic blink500 B2 1',
                'status' => 1, //1 true, it means asset no borrow
                'category_id' => 6, //1 is category id for speaker jabra 
                'created_at' => now(),
                'updated_at' => now()

            ],
            [
                'asset_code' => 'S02',
                'asset_name' => 'Saramonic blink500 B2 2',
                'status' => 1, //1 true, it means asset no borrow
                'category_id' => 6, //1 is category id for speaker jabra 
                'created_at' => now(),
                'updated_at' => now()

            ],
            [
                'asset_code' => 'S03',
                'asset_name' => 'Saramonic blink500 B2 3',
                'status' => 1, //1 true, it means asset no borrow
                'category_id' => 6, //1 is category id for speaker jabra 
                'created_at' => now(),
                'updated_at' => now()

            ],
            [
                'asset_code' => 'S04',
                'asset_name' => 'Saramonic blink500 B2 4',
                'status' => 1, //1 true, it means asset no borrow
                'category_id' => 6, //1 is category id for speaker jabra 
                'created_at' => now(),
                'updated_at' => now()

            ],

        ];

        DB::table('assets')->insert($data);
        // Asset::create($data);
    }
}
