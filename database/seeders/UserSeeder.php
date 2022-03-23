<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        #if root user not exist
        if (!User::whereName("root")->first()) {
            #root user
            $user = [
                "name" => "root",
                "email" => "root@root.com",
                "password" => Hash::make("r00t@Root")
            ];
            User::insert($user);
            #end
        }
        #end

        #create 50 fake users
        User::factory()->count(50)->create();
    }
}
