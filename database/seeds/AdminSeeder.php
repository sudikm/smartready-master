<?php

use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admin_users')->insert([
            'firstname' => 'Sudik',
            'lastname' => 'Maharana',
            'email' => 'neowwindia.test@gmail.com',
            'password' => bcrypt('admin123'),
            'status' => 'Active',
            'created_by' => '1',
            'modified_by' => '1'
        ]);
    }
}
