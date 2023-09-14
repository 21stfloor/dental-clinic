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
        Role::firstOrCreate(['guard_name' => 'web', 'name' => 'admin']);
        Role::firstOrCreate(['guard_name' => 'web', 'name' => 'patient']);
        Role::firstOrCreate(['guard_name' => 'web', 'name' => 'doctor']);
        $adminUser = User::factory()->create([
            'username' => 'admin1',
            'email' => 'admin1@email.com'
        ]);
        
        $adminUser->assignRole('admin');

        $doctorUser = User::factory()->create([
            'username' => 'doctor1',
            'email' => 'doctor1@email.com'
        ]);

        $doctorUser->assignRole('doctor');

        $patientUser = User::factory()->create([
            'username' => 'patient1',
            'email' => 'patien1@email.com'
        ]);

        $patientUser->assignRole('patient');

    }
}
