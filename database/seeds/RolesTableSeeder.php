<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'slug' => 'superadmin',
            'name' => 'Jemduk Super Admin',
        ]);
        
        DB::table('roles')->insert([
            'slug' => 'admin',
            'name' => 'Jemduk Admin',
        ]);
        
        DB::table('roles')->insert([
            'slug' => 'agent',
            'name' => 'Jemduk Agent',
        ]);

        DB::table('roles')->insert([
            'slug' => 'landlord',
            'name' => 'Jemduk landlord',
        ]);
    }
}
