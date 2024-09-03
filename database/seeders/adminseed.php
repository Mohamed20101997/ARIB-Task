<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class adminseed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::create([
            'phone' => '01015127991',
            'name' => 'admin',
            'email' =>'admin@admin.com',
            'password' => bcrypt('admin#123@password_')
        ]);
    }
}
