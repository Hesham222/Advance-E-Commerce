<?php

use App\Models\Admin;
use Illuminate\Database\Seeder;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->delete();
        $adminRecords = [
            ['id' => 1, 'name' =>'admin', 'type' => 'admin', 'mobile' => '0900000', 'email' => 'admin@gmail.com',
            'password' => '$2y$10$HKwlwCWAwiQRTPO8v/5oo.Bvk/QJ/z.UH0BUfjv9/76bMsoS0ehgy', 'image' =>'', 'status' => 1
            ],
            ['id' => 2, 'name' =>'Hesham', 'type' => 'admin', 'mobile' => '01100531939', 'email' => 'heshamashraf971@gmail.com',
            'password' => '$2y$10$HKwlwCWAwiQRTPO8v/5oo.Bvk/QJ/z.UH0BUfjv9/76bMsoS0ehgy', 'image' =>'', 'status' => 1
            ],
        ];
        DB::table('admins')->insert($adminRecords);

        // foreach ($adminRecords  as $key => $record) {

        //     Admin::create($record);
        // }
    }
}
