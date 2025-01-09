<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            [
                'name' => 'admin',
                'description' => 'Platform administrator with full access'
            ],
            [
                'name' => 'producer',
                'description' => 'Beat producer who can sell and manage their beats'
            ],
            [
                'name' => 'listener',
                'description' => 'Music enthusiast who can purchase and license beats'
            ],
            [
                'name' => 'moderator',
                'description' => 'Can moderate content and handle support requests'
            ]
        ];

        $permissions = [
            // Beat Management
            [
                'name' => 'upload-beats',
                'description' => 'Upload new beats to the platform'
            ],
            [
                'name' => 'edit-own-beats',
                'description' => 'Edit own beat details and pricing'
            ],
            [
                'name' => 'delete-beats',
                'description' => 'Remove beats from the platform'
            ],
            [
                'name' => 'download-purchased-beats',
                'description' => 'Download beats after purchase'
            ],

            [
                'name' => 'manage-users',
                'description' => 'Manage user accounts and access'
            ],
            [
                'name' => 'edit-profile',
                'description' => 'Edit own profile information'
            ],

            // Financial
            [
                'name' => 'view-own-earnings',
                'description' => 'View personal sales and earnings'
            ],
            [
                'name' => 'view-all-transactions',
                'description' => 'View all platform transactions'
            ],
            [
                'name' => 'process-refunds',
                'description' => 'Handle refund requests'
            ],

            // Support & Moderation
            [
                'name' => 'moderate-content',
                'description' => 'Moderate beats and user content'
            ],
            [
                'name' => 'manage-support-tickets',
                'description' => 'Handle customer support tickets'
            ]
        ];

        foreach ($roles as $role) {
            Role::create([
                'name' => $role['name'],
                'description' => $role['description']
            ]);
        }

        foreach ($permissions as $permission) {
            Permission::create([
                'name' => $permission['name'],
                'description' => $permission['description']
            ]);
        }
    }
}
