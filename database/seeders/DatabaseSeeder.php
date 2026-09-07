<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\ContactSetting;
use App\Models\ContactMessage;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // 1. Remove previous test users if any
        User::where('email', 'admin@motra.vn')->delete();

        // Admin User
        User::updateOrCreate(
            ['email' => 'superadmin@admin.com'],
            [
                'name' => 'Super Administrator',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]
        );

        // 2. Initial Contact Settings
        $settings = [
            [
                'key' => 'location',
                'value' => 'Đồng Nai Province, South Vietnam',
                'label' => 'Farm Location',
                'group' => 'contact',
            ],
            [
                'key' => 'trade_desk_email',
                'value' => 'wholesale@motra.vn',
                'label' => 'Wholesale & Trade Desk Email',
                'group' => 'contact',
            ],
            [
                'key' => 'retail_email',
                'value' => 'hello@motra.vn',
                'label' => 'Retail Customer Email',
                'group' => 'contact',
            ],
            [
                'key' => 'farm_visits',
                'value' => 'By appointment, Mon–Sat',
                'label' => 'Farm Visits Schedule',
                'group' => 'contact',
            ],
            [
                'key' => 'phone',
                'value' => '+84 (0) 251 388 9922',
                'label' => 'Contact Hotline',
                'group' => 'contact',
            ],
            [
                'key' => 'address',
                'value' => 'Thống Nhất District, Đồng Nai Province, Vietnam',
                'label' => 'Estate Physical Address',
                'group' => 'contact',
            ],
            [
                'key' => 'headline',
                'value' => 'Visit the estate, or start with a sample',
                'label' => 'Contact Section Headline',
                'group' => 'contact',
            ],
        ];

        foreach ($settings as $setting) {
            ContactSetting::updateOrCreate(['key' => $setting['key']], $setting);
        }

        // 3. Clear any dummy messages
        ContactMessage::truncate();
    }
}
