<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $role = Role::firstOrCreate(
            ['name' => 'super-admin', 'guard_name' => 'web'],
        );

        $user = User::query()->updateOrCreate(
            ['email' => env('ADMIN_EMAIL', 'admin@vault.local')],
            [
                'name' => env('ADMIN_NAME', 'Super Admin'),
                'password' => Hash::make(env('ADMIN_PASSWORD', 'password')),
            ],
        );

        if (! $user->hasRole($role)) {
            $user->assignRole($role);
        }
    }
}
