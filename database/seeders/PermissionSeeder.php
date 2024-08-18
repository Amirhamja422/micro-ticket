<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $date = date('Y-m-d H:i:s');

        DB::table('permissions')->insert([
            ## user route
            ['name' => 'user', 'group_id' => '1', 'guard_name' => "web", 'created_at' => $date, 'updated_at' => $date],
            ['name' => 'user.create', 'group_id' => '1', 'guard_name' => "web", 'created_at' => $date, 'updated_at' => $date],
            ['name' => 'user.edit', 'group_id' => '1', 'guard_name' => "web", 'created_at' => $date, 'updated_at' => $date],
            ['name' => 'user.status.change', 'group_id' => '1', 'guard_name' => "web", 'created_at' => $date, 'updated_at' => $date],

            ## client route
            ['name' => 'client', 'group_id' => '2', 'guard_name' => "web", 'created_at' => $date, 'updated_at' => $date],
            ['name' => 'client.create', 'group_id' => '2', 'guard_name' => "web", 'created_at' => $date, 'updated_at' => $date],
            ['name' => 'client.edit', 'group_id' => '2', 'guard_name' => "web", 'created_at' => $date, 'updated_at' => $date],
            ['name' => 'client.status.change', 'group_id' => '2', 'guard_name' => "web", 'created_at' => $date, 'updated_at' => $date],

            ## server route
            ['name' => 'server', 'group_id' => '3', 'guard_name' => "web", 'created_at' => $date, 'updated_at' => $date],
            ['name' => 'server.create', 'group_id' => '3', 'guard_name' => "web", 'created_at' => $date, 'updated_at' => $date],
            ['name' => 'server.edit', 'group_id' => '3', 'guard_name' => "web", 'created_at' => $date, 'updated_at' => $date],
            ['name' => 'server.status.change', 'group_id' => '3', 'guard_name' => "web", 'created_at' => $date, 'updated_at' => $date],

            ## host route
            ['name' => 'host', 'group_id' => '4', 'guard_name' => "web", 'created_at' => $date, 'updated_at' => $date],
            ['name' => 'host.create', 'group_id' => '4', 'guard_name' => "web", 'created_at' => $date, 'updated_at' => $date],
            ['name' => 'host.edit', 'group_id' => '4', 'guard_name' => "web", 'created_at' => $date, 'updated_at' => $date],
            ['name' => 'host.status.change', 'group_id' => '4', 'guard_name' => "web", 'created_at' => $date, 'updated_at' => $date],

            ## support type route
            ['name' => 'support.type', 'group_id' => '5', 'guard_name' => "web", 'created_at' => $date, 'updated_at' => $date],
            ['name' => 'support.type.create', 'group_id' => '5', 'guard_name' => "web", 'created_at' => $date, 'updated_at' => $date],
            ['name' => 'support.type.edit', 'group_id' => '5', 'guard_name' => "web", 'created_at' => $date, 'updated_at' => $date],
            ['name' => 'support.type.status.change', 'group_id' => '5', 'guard_name' => "web", 'created_at' => $date, 'updated_at' => $date],

            ## task type route
            ['name' => 'task.type', 'group_id' => '6', 'guard_name' => "web", 'created_at' => $date, 'updated_at' => $date],
            ['name' => 'task.type.create', 'group_id' => '6', 'guard_name' => "web", 'created_at' => $date, 'updated_at' => $date],
            ['name' => 'task.type.edit', 'group_id' => '6', 'guard_name' => "web", 'created_at' => $date, 'updated_at' => $date],
            ['name' => 'task.type.status.change', 'group_id' => '6', 'guard_name' => "web", 'created_at' => $date, 'updated_at' => $date],

            ## permission group route
            ['name' => 'permission.group', 'group_id' => '7', 'guard_name' => "web", 'created_at' => $date, 'updated_at' => $date],

            ## permission route
            ['name' => 'permission', 'group_id' => '8', 'guard_name' => "web", 'created_at' => $date, 'updated_at' => $date],

            ## role route
            ['name' => 'role', 'group_id' => '9', 'guard_name' => "web", 'created_at' => $date, 'updated_at' => $date],

            ## support route
            ['name' => 'support', 'group_id' => '10', 'guard_name' => "web", 'created_at' => $date, 'updated_at' => $date],

            ## project route
            ['name' => 'project', 'group_id' => '11', 'guard_name' => "web", 'created_at' => $date, 'updated_at' => $date],

            ## task route
            ['name' => 'task', 'group_id' => '12', 'guard_name' => "web", 'created_at' => $date, 'updated_at' => $date],

            ## ticket route
            ['name' => 'ticket', 'group_id' => '13', 'guard_name' => "web", 'created_at' => $date, 'updated_at' => $date],

            ## notice route
            ['name' => 'notice', 'group_id' => '14', 'guard_name' => "web", 'created_at' => $date, 'updated_at' => $date],

            ## notice show route
            ['name' => 'notices', 'group_id' => '15', 'guard_name' => "web", 'created_at' => $date, 'updated_at' => $date],

            ## storage route
            ['name' => 'storage', 'group_id' => '16', 'guard_name' => "web", 'created_at' => $date, 'updated_at' => $date],

            ## storage show route
            // ['name' => 'storages', 'group_id' => '17', 'guard_name' => "web", 'created_at' => $date, 'updated_at' => $date],

            ## signature show route
            ['name' => 'signature', 'group_id' => '17', 'guard_name' => "web", 'created_at' => $date, 'updated_at' => $date],

        ]);
    }
}
