<?php

namespace Database\Seeders\Ecommerce;

use App\Models\Ecommerce\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'name' => 'admin'
        ]);
        Role::create([
            'name' => 'blogger'
        ]);
        Role::create([
            'name' => 'viewer'
        ]);
    }
}
