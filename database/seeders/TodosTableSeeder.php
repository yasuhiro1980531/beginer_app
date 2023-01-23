<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Todo;

class TodosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'content' => 'プログラミングの勉強',
            'created_at' => '2023-01-01',
            'updated_at' => '2023-01-20'
        ];
        Todo::create($param);
    }
}
