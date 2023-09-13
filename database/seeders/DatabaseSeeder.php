<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        Role::create(['guard_name' => 'web', 'name' => 'admin']);
        Role::create(['guard_name' => 'web', 'name' => 'patient']);
        Role::create(['guard_name' => 'web', 'name' => 'doctor']);
        $user = User::factory()->create();
        
        $user->assignRole('admin');

    }
}
