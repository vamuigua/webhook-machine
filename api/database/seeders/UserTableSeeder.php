<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user_1 = new User();
        $user_1->name = "John Doe";
        $user_1->email = "johndoe@gmail.com";
        $user_1->email_verified_at = now();
        $user_1->password = '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'; // password
        $user_1->remember_token = Str::random(10);
        $user_1->save();

        $user_2 = new User();
        $user_2->name = "Jane Doe";
        $user_2->email = "janedoe@gmail.com";
        $user_2->email_verified_at = now();
        $user_2->password = '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'; // password
        $user_2->remember_token = Str::random(10);
        $user_2->save();
    }
}
