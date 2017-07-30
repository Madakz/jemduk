<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $superAdminCredentials = [
            'picture' => 'mad.jpg',
            'first_name' => 'Super',
            'last_name' => 'Admin',
            'phone_number' => '1234567890',
            'email' => 'superadmin@jemduk.com',
            'address' => 'Jos',
            'status' => 'Admin',
            'agent_number' => 'JEM001',
            'password' => 'secret',
            
        ];
        
        $superAdmin = Sentinel::registerAndActivate($superAdminCredentials, true);
        $role = Sentinel::findRoleBySlug('superadmin');
        $role->users()->attach($superAdmin);
        
        $adminCredentials = [
            'picture' => 'mad.jpg',
            'first_name' => 'Ayuba',
            'last_name' => 'jemduk',
            'phone_number' => '1234567890',
            'email' => 'admin@jemduk.com',
            'address' => 'Jos',
            'status' => 'agent',
            'agent_number' => 'JEM002',
            'password' => 'secret',
            
        ];
        
        $admin = Sentinel::registerAndActivate($adminCredentials, true);
        $role = Sentinel::findRoleBySlug('admin');
        $role->users()->attach($admin);
        
        $agentCredentials = [
            'picture' => 'mad.jpg',
            'first_name' => 'Madaki',
            'last_name' => 'Agent',
            'phone_number' => '1234567890',
            'email' => 'agent@jemduk.com',
            'address' => 'Jos',
            'status' => 'agent',
            'agent_number' => 'JEM003',
            'password' => 'secret',
            
        ];
        
        $agent = Sentinel::registerAndActivate($agentCredentials, true);
        $role = Sentinel::findRoleBySlug('agent');
        $role->users()->attach($agent);
    }
}
