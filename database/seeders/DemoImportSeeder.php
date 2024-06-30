<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Courier;
use App\Models\MenuBar;
use App\Models\OrderStatus;
use App\Models\ProductSize;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DemoImportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // <!-- NAV MENU SEEDER -->
        $mainMenus = [
            [
                'menu_name' => 'Home',
                'menu_link' => '/',
                'menu_order' => 1,
                'menu_status' => 1,

            ],
            [
                'menu_name' => 'Categories',
                'menu_link' => '/category',
                'menu_order' => 2,
                'menu_status' => 1,
            ],
            [
                'menu_name' => 'Offers',
                'menu_link' => '/offer',
                'menu_order' => 3,
                'menu_status' => 1,
            ]
        ];
        foreach ($mainMenus as $key => $menu) {
            MenuBar::create([
                'menu_name' => $menu['menu_name'],
                'menu_link' => $menu['menu_link'],
                'menu_order' => $menu['menu_order'],
                'menu_status' => $menu['menu_status'],
            ]);
        }

        // Demo User Create Seeder
        $userEmails = ['staff@mail.com', 'manager@mail.com', 'customer@mail.com'];
        foreach ($userEmails as  $uEmail) {
            $user = User::create(
                [
                    'name' => fake()->name,
                    'email' => $uEmail,
                    'password' => Hash::make('password'),
                    'slug' => uniqid('', true),
                    'online_status' => $uEmail === 'staff@mail.com' ? 1 : 0,
                ]);
                if ($uEmail === 'staff@mail.com') {
                    $user->assignRole('User');
                }
                elseif ($uEmail === 'manager@mail.com') {
                    $user->assignRole('Manager');
                }
                else {
                    $user->assignRole('Customer');
                }
            // User Assign
        }


        // COURIER DEMO SEEDER
        $couriers = [
            'Steadfast Courier', 'REDX BD', 'Sundarban Courier'
        ];
        foreach ($couriers as $courier) {
            Courier::create([
                'courier_name' => $courier,
                'courier_slug' => uniqid(),
                'courier_charge' => 150,
                'courier_city' => 1,
                'courier_zone' => 1,
                'courier_creator' => 1,
            ]);
        }

        // CITY DEMO SEEDER
        $cities = [
            'Dhaka', 'Narayangonj', 'Gazipur', 'Chattogram', 'Khulna', 'Sylhet', 'Mymensingh'
        ];
        foreach ($cities as $city) {
            City::create([
                'city_name' => $city,
                'city_slug' => uniqid()
            ]);
        }

        // SIZE DEMO SEEDER
        $sizes = [
            'S', 'M', 'L', 'XL', 'XXL'
        ];
        foreach ($sizes as $size) {
            ProductSize::create([
                'size_name' => $size,
                'size_slug' => uniqid()
            ]);
        }

        // ORDER STATUS DEMO SEEDER
        $orderStatuses = [
            'Pending', 'Processing', 'Holding', 'Canceled', 'Complected', 'Invoice', 'Stock Out', 'Delivery',
            'Lost', 'Return', 'Delivered', 'Payment Collected',
        ];
        foreach ($orderStatuses as $key => $status) {
            OrderStatus::create([
                'os_name' => $status,
                'os_color' => '#000',
                'os_orderby' => $key + 1,
                'os_slug' => uniqid()
            ]);
        }
    }
}
