<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Role::create(['name' => 'User', 'guard_name' => 'web'])
        //     ->givePermissionTo(
        //         'Read-Users',
        //         'Update-User-Status',
        //     );

        // Role::create(['name' => 'Employee', 'guard_name' => 'web'])
        //     ->givePermissionTo(
        //         'Read-Employees',
        //         'Create-Employee',
        //         'Update-Employee',
        //     );

        // Role::create(['name' => 'Boarding', 'guard_name' => 'web'])
        //     ->givePermissionTo(
        //         'Create-Boarding',
        //         'Read-Boardings',
        //         'Update-Boarding',
        //         'Delete-Boarding',
        //     );

        // Role::create(['name' => 'Ads', 'guard_name' => 'web'])
        //     ->givePermissionTo(
        //         'Create-Ads',
        //         'Read-Adses',
        //         'Update-Ads',
        //         'Delete-Ads',
        //     );

        // Role::create(['name' => 'Egency', 'guard_name' => 'web'])
        //     ->givePermissionTo(
        //         'Create-Egency',
        //         'Read-Egencies',
        //         'Update-Egency',
        //         'Delete-Egency',
        //         'Show-Egency',
        //     );

        // Role::create(['name' => 'Wallet', 'guard_name' => 'web'])
        //     ->givePermissionTo(
        //         'Create-Wallet',
        //         'Read-Wallets'
        //     );

        // Role::create(['name' => 'Country', 'guard_name' => 'web'])
        //     ->givePermissionTo(
        //         'Create-Country',
        //         'Read-Countries',
        //         'Update-Country'
        //     );

        // Role::create(['name' => 'City', 'guard_name' => 'web'])
        //     ->givePermissionTo(
        //         'Create-City',
        //         'Read-Cities',
        //         'Update-City',
        //     );

        // Role::create(['name' => 'Room Type', 'guard_name' => 'web'])
        //     ->givePermissionTo(
        //         'Read-Rooms-types',
        //         'Create-Room-types',
        //         'Update-Room-types',
        //     );

        // Role::create(['name' => 'Room', 'guard_name' => 'web'])
        //     ->givePermissionTo(
        //         'Read-Rooms',
        //         'Update-Room-Status',
        //         'Update-Room-Home',
        //         'Update-Room-Favorite',
        //     );

        // Role::create(['name' => 'Home', 'guard_name' => 'web'])
        //     ->givePermissionTo(
        //         'Read-Rooms-Home',
        //     );

        // Role::create(['name' => 'Favorite', 'guard_name' => 'web'])
        //     ->givePermissionTo(
        //         'Read-Rooms-Favorite',
        //     );

        // Role::create(['name' => 'Group', 'guard_name' => 'web'])
        //     ->givePermissionTo(
        //         'Read-Groups',
        //         'Update-Group-Status'
        //     );

        // Role::create(['name' => 'Post', 'guard_name' => 'web'])
        //     ->givePermissionTo(
        //         'Read-Posts',
        //         'Create-Post',
        //         'Update-Post',
        //         'Delete-Post',
        //         'Update-Post-Status'
        //     );

        // Role::create(['name' => 'Events', 'guard_name' => 'web'])
        //     ->givePermissionTo(
        //         'Read-Events',
        //         'Create-Event',
        //         'Update-Event'
        //     );

        // Role::create(['name' => 'Team', 'guard_name' => 'web'])
        //     ->givePermissionTo(
        //         'Read-Teams',
        //         'Create-Team',
        //         'Update-Team'
        //     );

        // Role::create(['name' => 'Pages', 'guard_name' => 'web'])
        //     ->givePermissionTo(
        //         'Read-Pages',
        //         'Read-Contact-Us',
        //         'Create-Duration-Agreement',
        //         'Create-Privacy',
        //         'Create-Condition'
        //     );

        // Role::create(['name' => 'Rule', 'guard_name' => 'web'])
        //     ->givePermissionTo(
        //         'Read-Rules'
        //     );

        // Role::create(['name' => 'Permission', 'guard_name' => 'web'])
        //     ->givePermissionTo(
        //         'Read-Permissions'
        //     );

        Role::create(['name' => 'Dashboard', 'guard_name' => 'web'])
            ->givePermissionTo(
                'Read-Dasboard'
            );
    }
}
