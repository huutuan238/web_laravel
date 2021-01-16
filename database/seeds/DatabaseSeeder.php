<?php

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
        // $this->call(UserSeeder::class);
        $data = [
        	'admin_email'=>'tuan@gmail.com',
        	'admin_password'=>bcrypt('123456'),
        	'admin_name'=>'tuan',
        	'admin_phone'=>'09888888',
        ];
        DB::table('tbl_admin')->insert($data);
    }
}
