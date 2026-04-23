<?php
namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        // Create roles
        $superAdmin = Role::firstOrCreate(['name' => 'super_admin', 'guard_name' => 'web']);
        $editor = Role::firstOrCreate(['name' => 'editor', 'guard_name' => 'web']);
        $viewer = Role::firstOrCreate(['name' => 'viewer', 'guard_name' => 'web']);

        // Create permissions
        $permissions = [
            'manage_events', 'manage_actions', 'manage_documents',
            'manage_testimonials', 'manage_partners', 'view_donations',
            'manage_settings', 'manage_stats', 'manage_newsletter',
        ];
        foreach ($permissions as $perm) {
            Permission::firstOrCreate(['name' => $perm, 'guard_name' => 'web']);
        }

        // Super admin gets all
        $superAdmin->syncPermissions($permissions);
        // Editor gets content management
        $editor->syncPermissions(['manage_events','manage_actions','manage_documents','manage_testimonials','manage_partners','manage_newsletter']);
        // Viewer gets read-only
        $viewer->syncPermissions(['view_donations']);

        // Create super admin user
        $admin = User::firstOrCreate(
            ['email' => 'admin@ong-infentil.org'],
            [
                'name' => 'Super Admin',
                'password' => Hash::make('Admin@2024!'),
                'email_verified_at' => now(),
            ]
        );
        $admin->assignRole('super_admin');

        $this->command->info('✓ Admin created: admin@ong-infentil.org / Admin@2024!');
    }
}
