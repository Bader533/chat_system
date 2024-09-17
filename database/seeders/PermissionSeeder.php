<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // === User
        // Permission::create(['name' => 'Read-Users', 'guard_name' => 'web']);
        // Permission::create(['name' => 'Update-User-Status', 'guard_name' => 'web']);

        // // === Employee
        // Permission::create(['name' => 'Create-Employee', 'guard_name' => 'web']);
        // Permission::create(['name' => 'Read-Employees', 'guard_name' => 'web']);
        // Permission::create(['name' => 'Update-Employee', 'guard_name' => 'web']);

        // // === Boarding
        // Permission::create(['name' => 'Create-Boarding', 'guard_name' => 'web']);
        // Permission::create(['name' => 'Read-Boardings', 'guard_name' => 'web']);
        // Permission::create(['name' => 'Update-Boarding', 'guard_name' => 'web']);
        // Permission::create(['name' => 'Delete-Boarding', 'guard_name' => 'web']);

        // // === Eds
        // Permission::create(['name' => 'Create-Ads', 'guard_name' => 'web']);
        // Permission::create(['name' => 'Read-Adses', 'guard_name' => 'web']);
        // Permission::create(['name' => 'Update-Ads', 'guard_name' => 'web']);
        // Permission::create(['name' => 'Delete-Ads', 'guard_name' => 'web']);

        // // === Egency
        // Permission::create(['name' => 'Create-Egency', 'guard_name' => 'web']);
        // Permission::create(['name' => 'Read-Egencies', 'guard_name' => 'web']);
        // Permission::create(['name' => 'Update-Egency', 'guard_name' => 'web']);
        // Permission::create(['name' => 'Delete-Egency', 'guard_name' => 'web']);
        // Permission::create(['name' => 'Show-Egency', 'guard_name' => 'web']);

        // // === Wallet
        // Permission::create(['name' => 'Create-Wallet', 'guard_name' => 'web']);
        // Permission::create(['name' => 'Read-Wallets', 'guard_name' => 'web']);

        // // === Country
        // Permission::create(['name' => 'Create-Country', 'guard_name' => 'web']);
        // Permission::create(['name' => 'Read-Countries', 'guard_name' => 'web']);
        // Permission::create(['name' => 'Update-Country', 'guard_name' => 'web']);

        // // === City
        // Permission::create(['name' => 'Create-City', 'guard_name' => 'web']);
        // Permission::create(['name' => 'Read-Cities', 'guard_name' => 'web']);
        // Permission::create(['name' => 'Update-City', 'guard_name' => 'web']);

        // // === Room Type
        // Permission::create(['name' => 'Read-Rooms-types', 'guard_name' => 'web']);
        // Permission::create(['name' => 'Create-Room-types', 'guard_name' => 'web']);
        // Permission::create(['name' => 'Update-Room-types', 'guard_name' => 'web']);

        // // === Room
        // Permission::create(['name' => 'Read-Rooms', 'guard_name' => 'web']);
        // Permission::create(['name' => 'Update-Room-Status', 'guard_name' => 'web']);
        // Permission::create(['name' => 'Update-Room-Home', 'guard_name' => 'web']);
        // Permission::create(['name' => 'Update-Room-Favorite', 'guard_name' => 'web']);

        // // === Room Favorite
        // Permission::create(['name' => 'Read-Rooms-Home', 'guard_name' => 'web']);

        // // === Room Favorite
        // Permission::create(['name' => 'Read-Rooms-Favorite', 'guard_name' => 'web']);

        // // === Group
        // Permission::create(['name' => 'Read-Groups', 'guard_name' => 'web']);
        // Permission::create(['name' => 'Update-Group-Status', 'guard_name' => 'web']);

        // // === Post
        // Permission::create(['name' => 'Read-Posts', 'guard_name' => 'web']);
        // Permission::create(['name' => 'Create-Post', 'guard_name' => 'web']);
        // Permission::create(['name' => 'Update-Post', 'guard_name' => 'web']);
        // Permission::create(['name' => 'Delete-Post', 'guard_name' => 'web']);
        // Permission::create(['name' => 'Update-Post-Status', 'guard_name' => 'web']);

        // // === Event
        // Permission::create(['name' => 'Read-Events', 'guard_name' => 'web']);
        // Permission::create(['name' => 'Create-Event', 'guard_name' => 'web']);
        // Permission::create(['name' => 'Update-Event', 'guard_name' => 'web']);

        // // === Team
        // Permission::create(['name' => 'Read-Teams', 'guard_name' => 'web']);
        // Permission::create(['name' => 'Create-Team', 'guard_name' => 'web']);
        // Permission::create(['name' => 'Update-Team', 'guard_name' => 'web']);

        // === Pages
        // Permission::create(['name' => 'Read-Pages', 'guard_name' => 'web']);
        // Permission::create(['name' => 'Read-Contact-Us', 'guard_name' => 'web']);
        // Permission::create(['name' => 'Create-Duration-Agreement', 'guard_name' => 'web']);
        // Permission::create(['name' => 'Create-Privacy', 'guard_name' => 'web']);
        // Permission::create(['name' => 'Create-Condition', 'guard_name' => 'web']);

        // // === Rules
        // Permission::create(['name' => 'Read-Rules', 'guard_name' => 'web']);

        // // === Permission
        // Permission::create(['name' => 'Read-Permissions', 'guard_name' => 'web']);

        // === Dasboard
        Permission::create(['name' => 'Read-Dasboard', 'guard_name' => 'web']);
    }
}
