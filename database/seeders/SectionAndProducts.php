<?php

namespace Database\Seeders;

use App\Models\sections;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class SectionAndProducts extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('sections')->insert([
            [
            'section_name' => 'طبى',
            'description' => 'أجهزة طبية',
             'Created_by' => '1'
        ],
            [
            'section_name' => 'زراعى',
            'description' => 'أجهزة زراعية',
                'Created_by' => '1'

        ],[
            'section_name' => 'ميكانيكى',
            'description' => 'أجهزة ميكانيكية',
                'Created_by' => '1'

        ],
            ]);
        $section_id = DB::table('sections')->pluck('id');
        DB::table('products')->insert([

            ['product_name' => 'كمامة', 'section_id' => $section_id[0],
                'description' => 'Face mask'
                ],
            ['product_name' => 'سماعه', 'section_id' => $section_id[0], 'description' => 'AirPods'
            ],
            ['product_name' => 'جرار', 'section_id' => $section_id[1], 'description' => 'جرار للاراضى'
                ],
            ['product_name' => 'فأس', 'section_id' => $section_id[1], 'description' => 'بيد خشبية'
                ],
            ['product_name' => 'تروس', 'section_id' => $section_id[2], 'description' => 'متعددة الاحجام'
                ],
            ['product_name' => 'مفكات', 'section_id' => $section_id[2], 'description' => 'ضد الكهرباء'
                ],

            ]);



    }
}
