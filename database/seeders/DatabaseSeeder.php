<?php

namespace Database\Seeders;

use App\Models\PaymentMethod;
use App\Models\ProductStatus;
use App\Models\StatusOrder;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        StatusOrder::create(['title' => 'Waiting']);
        StatusOrder::create(['title' => 'Done']);
        StatusOrder::create(['title' => 'Cancel']);

        ProductStatus::create(['title' => 'Active']);
        ProductStatus::create(['title' => 'Non-Active']);
        ProductStatus::create(['title' => 'Sold-Out']);

        PaymentMethod::create(['title' => 'Tunai']);
        PaymentMethod::create(['title' => 'LinkAja']);
        PaymentMethod::create(['title' => 'GoPay']);
        PaymentMethod::create(['title' => 'Ovo']);
        PaymentMethod::create(['title' => 'Dana']);

        User::create([
            'name' => 'supervisor',
            'email' => 'supervisor@supervisor',
            'password' => bcrypt('supervisor'),
            'role' => 1,
        ]);

        User::create([
            'name' => 'head-cafe',
            'email' => 'headcafe@headcafe',
            'password' => bcrypt('headcafe'),
            'role' => 2,
        ]);

        User::create([
            'name' => 'admin-stock',
            'email' => 'adminstock@adminstock',
            'password' => bcrypt('adminstock'),
            'role' => 3,
        ]);
        User::create([
            'name' => 'cashier',
            'email' => 'cashier@cashier',
            'password' => bcrypt('cashier'),
            'role' => 4,
        ]);

    }
}
