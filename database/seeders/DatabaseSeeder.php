<?php

namespace Database\Seeders;

use App\Models\Tables;
use App\Models\TableTypes;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $table_types = array(
            array('id' => 1, 'table_type' => 'Small', 'serving_capacity' => '2'),
            array('id' => 2, 'table_type' => 'Medium', 'serving_capacity' => '4'),
            array('id' => 3, 'table_type' => 'Large', 'serving_capacity' => '6'),
        );

        $tables = array(
            array('table_number' => 1, 'table_type_id' => 1),
            array('table_number' => 2, 'table_type_id' => 1),
            array('table_number' => 3, 'table_type_id' => 1),
            array('table_number' => 4, 'table_type_id' => 1),
            array('table_number' => 5, 'table_type_id' => 1),
            array('table_number' => 6, 'table_type_id' => 1),
            array('table_number' => 7, 'table_type_id' => 1),
            array('table_number' => 8, 'table_type_id' => 1),
            array('table_number' => 9, 'table_type_id' => 1),
            array('table_number' => 10, 'table_type_id' => 2),
            array('table_number' => 11, 'table_type_id' => 2),
            array('table_number' => 12, 'table_type_id' => 2),
            array('table_number' => 13, 'table_type_id' => 2),
            array('table_number' => 14, 'table_type_id' => 3),
            array('table_number' => 15, 'table_type_id' => 3),
        );

        foreach ($table_types as $type) {
            TableTypes::create($type);
        }

        foreach ($tables as $table) {
            Tables::create($table);
        }
    }
}
