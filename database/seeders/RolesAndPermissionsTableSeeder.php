<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsTableSeeder extends Seeder
{
    protected $toTruncate = [
        'role_has_permissions',
        'permissions'
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();

        foreach($this->toTruncate as $table) {
            DB::table($table)->truncate();
        }

        Schema::enableForeignKeyConstraints();

        $permissions = [
            // campaigns 
            ['group' => 'campaigns', 'name' => 'view_campaigns', 'title' => 'View campaigns', 'guard_name' => 'web'],
            ['group' => 'campaigns', 'name' => 'add_campaigns', 'title' => 'Add campaigns', 'guard_name' => 'web'],
            ['group' => 'campaigns', 'name' => 'edit_campaigns', 'title' => 'Edit campaigns', 'guard_name' => 'web'],
            ['group' => 'campaigns', 'name' => 'delete_campaigns', 'title' => 'Delete campaigns', 'guard_name' => 'web'],

            // landings
            ['group' => 'landings', 'name' => 'view_landings', 'title' => 'View landings', 'guard_name' => 'web'],
            ['group' => 'landings', 'name' => 'add_landings', 'title' => 'Add landings', 'guard_name' => 'web'],
            ['group' => 'landings', 'name' => 'edit_landings', 'title' => 'Edit landings', 'guard_name' => 'web'],
            ['group' => 'landings', 'name' => 'delete_landings', 'title' => 'Delete landings', 'guard_name' => 'web'],

            // clients
            ['group' => 'clients', 'name' => 'view_clients', 'title' => 'View clients', 'guard_name' => 'web'],
            ['group' => 'clients', 'name' => 'add_clients', 'title' => 'Add clients', 'guard_name' => 'web'],
            ['group' => 'clients', 'name' => 'edit_clients', 'title' => 'Edit clients', 'guard_name' => 'web'],
            ['group' => 'clients', 'name' => 'delete_clients', 'title' => 'Delete clients', 'guard_name' => 'web'],

            // countries
            ['group' => 'countries', 'name' => 'view_countries', 'title' => 'View countries', 'guard_name' => 'web'],
            ['group' => 'countries', 'name' => 'add_countries', 'title' => 'Add countries', 'guard_name' => 'web'],
            ['group' => 'countries', 'name' => 'edit_countries', 'title' => 'Edit countries', 'guard_name' => 'web'],
            ['group' => 'countries', 'name' => 'delete_countries', 'title' => 'Delete countries', 'guard_name' => 'web'],

            // subscriptions
            ['group' => 'subscriptions', 'name' => 'view_subscriptions', 'title' => 'View subscriptions', 'guard_name' => 'web'],
            ['group' => 'subscriptions', 'name' => 'edit_subscriptions', 'title' => 'Edit subscriptions', 'guard_name' => 'web'],

            // cards
            ['group' => 'cards', 'name' => 'view_cards', 'title' => 'View cards', 'guard_name' => 'web'],
            ['group' => 'cards', 'name' => 'add_cards', 'title' => 'Add cards', 'guard_name' => 'web'],
            ['group' => 'cards', 'name' => 'edit_cards', 'title' => 'Edit cards', 'guard_name' => 'web'],

            //testimonials
            ['group' => 'testimonials', 'name' => 'view_testimonials', 'title' => 'View testimonials', 'guard_name' => 'web'],
            ['group' => 'testimonials', 'name' => 'add_testimonials', 'title' => 'Add testimonials', 'guard_name' => 'web'],
            ['group' => 'testimonials', 'name' => 'edit_testimonials', 'title' => 'Edit testimonials', 'guard_name' => 'web'],

            //footer pages
            ['group' => 'pages', 'name' => 'view_pages', 'title' => 'View pages', 'guard_name' => 'web'],
            ['group' => 'pages', 'name' => 'add_pages', 'title' => 'Add pages', 'guard_name' => 'web'],
            ['group' => 'pages', 'name' => 'edit_pages', 'title' => 'Edit pages', 'guard_name' => 'web'],

            //settings
            ['group' => 'settings', 'name' => 'edit_settings', 'title' => 'Edit settings', 'guard_name' => 'web'],



        ];

        Permission::insert($permissions);

        $clientPermissions = Permission::whereIn('group', [
            'campaigns', 'landings', 'subscriptions', 'cards'
        ])->get();
        $adminPermissions = Permission::whereIn('group', [
            'campaigns', 'landings', 'clients', 'countries', 'testimonials', 'pages', 'settings'
        ])->get();

        $admin = Role::updateOrCreate(['name' => 'admin'], ['title' => 'Admin']);
        $client = Role::updateOrCreate(['name' => 'client'], ['title' => 'Client']);
        $client->permissions()->sync($clientPermissions);
        $admin->permissions()->sync($adminPermissions);
    }
}
