<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class MakeAdminSeeder extends Seeder
{
    public function run()
    {
        $user = User::where('email', 'putingbuhok1@gmail.com')->first();
        if ($user) {
            $user->role = 'admin'; // Or: $user->is_admin = true;
            $user->save();
        }
    }
}
