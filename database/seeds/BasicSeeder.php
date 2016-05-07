<?php

use Illuminate\Database\Seeder;
use App\Role;
use App\Permission;
use App\User;
use App\Company;

class BasicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $createPost = new Permission();
        $createPost->name         = 'admin_full_access';
        $createPost->display_name = 'admin full access'; // optional
        // Allow a user to...
        $createPost->description  = 'Have access to all things'; // optional
        $createPost->save();

        $owner = new Role();
        $owner->name         = 'company_admin';
        $owner->display_name = 'Company Admin'; // optional
        $owner->description  = 'User is the admin of a given company'; // optional
        $owner->save();

        $admin = new Role();
        $admin->name         = 'admin';
        $admin->display_name = 'User Administrator'; // optional
        $admin->description  = 'User is allowed to manage and edit other users'; // optional
        $admin->save();
        $admin->givePermissionTo($createPost);

        $company = Company::create([
            'name'          => 'aabus',
            'year_founded'  => '1995',
            'rating'        => '10',
            'verified'      => true,
            'code'          => 'AA',
        ]);

        User::create([
            'first_name'    => 'yetian',
            'last_name'     => 'mao',
            'email'         => 'yetian.mao@gmail.com',
            'password'      => Hash::make("Tianjiayou"),
        ]);

        User::create([
            'first_name'    => 'admin',
            'last_name'     => 'admin',
            'email'         => 'admin@gmail.com',
            'password'      => Hash::make("admin"),
        ])->assignRole("admin");

        User::create([
            'first_name'    => 'aabus',
            'last_name'     => 'aabus',
            'email'         => 'aabus@gmail.com',
            'password'      => Hash::make("aabus"),
            'company_id'    => $company->id,
        ])->assignRole("company_admin");
    }
}
