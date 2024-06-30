<?php

namespace Database\Seeders;

use App\Models\Analytics;
use App\Models\BasicSetting;
use App\Models\ContactInfo;
use App\Models\SMSSetting;
use App\Models\SocialSetting;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class SetupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // Basic Setting Seeder
        BasicSetting::create([
            'basic_company' => 'আমার দেশ আমার পণ্য',
            'invoice_code' => 'ADAP',
        ]);
        // Social Media Seeder
        SocialSetting::create(['sm_facebook' => '']);
        // SMS SETTING SETUP
        SMSSetting::create(['sms_type' => 1]);
        // Contact Info Seeder
        ContactInfo::create(['ci_working_info' => 'Mon - FRI / 9:30 AM - 6:30 PM']);
        // Analytics Seeder
        Analytics::create(['google_analytic' => '']);
        // Single User Create
        $user = User::create(
            [
                'name' => 'Super Admin',
                'email' => 'superadmin@mail.com',
                'password' => Hash::make('password'),
                'slug' => uniqid('', true),
            ],
        );

        // Multi Role Create
        $roles = ['Super Admin', 'Admin', 'Manager', 'User', 'Customer'];
        foreach ($roles as  $role) {
            Role::create(['name' => $role]);
        }
        // User Assign
        $user->assignRole('Super Admin');

        // Group Wise User Permissions Create
        $permissions = [
            'User' => [
                'user list',
                'user create',
                'user edit',
                'user delete',
            ],
            'Customer' => [
                'customer list',
                'customer create',
                'customer edit',
                'customer delete',
            ],
            'Courier' => [
                'courier list',
                'courier create',
                'courier edit',
                'courier delete',
            ],
            'Product' => [
                'product list',
                'product create',
                'product edit',
                'product delete',
            ],
            'Category' => [
                'category list',
                'category create',
                'category edit',
                'category delete',
            ],
            'SubCategory' => [
                'subCategory list',
                'subCategory create',
                'subCategory edit',
                'subCategory delete',
            ],
            'Brand' => [
                'brand list',
                'brand create',
                'brand edit',
                'brand delete',
            ],
            'Color' => [
                'color list',
                'color create',
                'color edit',
                'color delete',
            ],
            'Size' => [
                'size list',
                'size create',
                'size edit',
                'size delete',
            ],
            'Banner' => [
                'banner list',
                'banner create',
                'banner edit',
                'banner delete',
            ],
            'Partner' => [
                'partner list',
                'partner create',
                'partner edit',
                'partner delete',
            ],
            'Report' => [
                'report list',
                'report create',
                'report edit',
                'report delete',
            ],
            'Stock' => [
                'stock list',
                'stock create',
                'stock edit',
                'stock delete',
            ],
            'Coupon' => [
                'coupon list',
                'coupon create',
                'coupon edit',
                'coupon delete',
            ],
            'Subscriber' => [
                'subscriber list',
                'subscriber create',
                'subscriber edit',
                'subscriber delete',
            ],
            'SupportMessage' => [
                'supportMessage list',
                'supportMessage create',
                'supportMessage edit',
                'supportMessage delete',
            ],
            'Setting' => [
                'setting list',
                'setting create',
                'setting edit',
                'setting delete',
            ],
            'FileManager' => [
                'fileManager list',
                'fileManager create',
                'fileManager edit',
                'fileManager delete',
            ],
            'Blog' => [
                'blog list',
                'blog create',
                'blog edit',
                'blog delete',
            ],
            'Tag' => [
                'tag list',
                'tag create',
                'tag edit',
                'tag delete',
            ],
            'Page' => [
                'page list',
                'page create',
                'page edit',
                'page delete',
            ],
            'Order' => [
                'order list',
                'order create',
                'order edit',
                'order delete',
                'pending Order',
                'processing Order',
                'holding Order',
                'canceled Order',
                'complected Order',
                'pendingInvoice Order',
                'invoice Order',
                'invoicePrint Order',
                'stockOut Order',
                'delivered Order',
                'return Order',
                'lost Order',
            ]
        ];

        // Get Role
        $role = Role::firstOrFail();

        // Assign Permissions To Role
        foreach ($permissions as $group => $names) {
            foreach ($names as $permission) {
                Permission::create([
                    'name' => $permission,
                    'group' => $group
                ]);
                $role->givePermissionTo($permission);
            }
        }
    }
}
