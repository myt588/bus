<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Role;
use App\Permission;
use App\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        DB::table('companies')->delete();
        factory(App\Company::class, 10)->create();

        DB::table('tickets')->delete();
        factory(App\Ticket::class, 10)->create();

        DB::table('buses')->delete();
        factory(App\Bus::class, 30)->create();

        DB::table('stations')->delete();
        factory(App\Station::class, 10)->create();

        DB::table('trips')->delete();
        factory(App\Trip::class, 10)->create();

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

        User::create([
            'name'      => 'yetian',
            'email'     => 'yetian.mao@gmail.com',
            'password'  => Hash::make("Tianjiayou"),
        ]);

        User::create([
            'name'      => 'admin',
            'email'     => 'admin@gmail.com',
            'password'  => Hash::make("admin"),
        ])->assignRole("admin");

        User::create([
            'name'      => 'aabus',
            'email'     => 'aabus@gmail.com',
            'password'  => Hash::make("aabus"),
        ]);

        Model::reguard();
    }
}
