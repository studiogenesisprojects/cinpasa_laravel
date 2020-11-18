<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use App\Models\Section;
use App\Models\Permission;


class UserBack extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Roles
        $admin = Role::create([
            "name" => "Admin",
        ]);

        //add permissions to admin
        foreach(Section::all() as $section){
            Permission::create([
                "read" => true,
                "write" => true,
                "role_id" => $admin->id,
                "section_id" => $section->id,
            ]);
        }

        User::create([
            'name' => 'studiogenesis',
            'email' => 'info@studiogenesis.es',
            'password' => '1234',
            'active' => 1,
            'admin' => 1,
            "role_id" => $admin->id,
        ]);

        User::create([
            'name' => 'yassine',
            'email' => 'yassine.elgarras@studiogenesis.es',
            'password' => '1234',
            'active' => 1,
            'admin' => 1,
            "role_id" => $admin->id,
        ]);
    }
}