<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\Doctor;
use App\Models\Patient;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::create(['name' => 'edit articles']);
        Permission::create(['name' => 'delete articles']);
        Permission::create(['name' => 'publish articles']);
        Permission::create(['name' => 'unpublish articles']);
        
        $adminRole = Role::firstOrCreate(['guard_name' => 'web', 'name' => 'admin']);
        $adminRole->givePermissionTo(Permission::all());

        $patientRole = Role::firstOrCreate(['guard_name' => 'web', 'name' => 'patient']);
        $patientRole->givePermissionTo('edit articles');
        
        $doctorRole = Role::firstOrCreate(['guard_name' => 'web', 'name' => 'doctor']);
        $doctorRole->givePermissionTo(['publish articles', 'unpublish articles']);

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

        Doctor::factory()->create([
            'user_id' => $doctorUser->id,
            'email' => 'doctor1@email.com',
            'first_name' => $doctorUser->first_name,
            'last_name' => $doctorUser->last_name,
            'contact_number' => $doctorUser->contact_number
        ]);

        $patientUser = User::factory()->create([
            'username' => 'patient1',
            'email' => 'patien1@email.com'
        ]);

        $patientUser->assignRole('patient');

        Patient::factory()->create([
            'user_id' => $patientUser->id,
            'email' => 'patien1@email.com',
            'first_name' => $patientUser->first_name,
            'last_name' => $patientUser->last_name,
            'contact_number' => $patientUser->contact_number
        ]);

    }
}
