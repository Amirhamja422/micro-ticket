<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $date = date('Y-m-d H:i:s');

        DB::table('permission_groups')->insert([
            ['name' => 'Users', 'guard_name' => "web", 'created_at' => $date, 'updated_at' => $date],
            ['name' => 'Clients', 'guard_name' => "web", 'created_at' => $date, 'updated_at' => $date],
            ['name' => 'Servers', 'guard_name' => "web", 'created_at' => $date, 'updated_at' => $date],
            ['name' => 'Host Info', 'guard_name' => "web", 'created_at' => $date, 'updated_at' => $date],
            ['name' => 'Support Type', 'guard_name' => "web", 'created_at' => $date, 'updated_at' => $date],
            ['name' => 'Task Type', 'guard_name' => "web", 'created_at' => $date, 'updated_at' => $date],
            ['name' => 'Permission Group', 'guard_name' => "web", 'created_at' => $date, 'updated_at' => $date],
            ['name' => 'Permission', 'guard_name' => "web", 'created_at' => $date, 'updated_at' => $date],
            ['name' => 'Role', 'guard_name' => "web", 'created_at' => $date, 'updated_at' => $date],
            ['name' => 'Support', 'guard_name' => "web", 'created_at' => $date, 'updated_at' => $date],
            ['name' => 'Project', 'guard_name' => "web", 'created_at' => $date, 'updated_at' => $date],
            ['name' => 'Assign Work', 'guard_name' => "web", 'created_at' => $date, 'updated_at' => $date],
            ['name' => 'Ticket', 'guard_name' => "web", 'created_at' => $date, 'updated_at' => $date],
            ['name' => 'Notice', 'guard_name' => "web", 'created_at' => $date, 'updated_at' => $date],
            ['name' => 'Notices', 'guard_name' => "web", 'created_at' => $date, 'updated_at' => $date],
            ['name' => 'Storage', 'guard_name' => "web", 'created_at' => $date, 'updated_at' => $date],
            ['name' => 'Signature', 'guard_name' => "web", 'created_at' => $date, 'updated_at' => $date],
        ]);
    }
}
