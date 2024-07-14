<?php

namespace Database\Seeders;

use App\Models\Forecast;
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
//        StatusOrder::create(['title' => 'Waiting']);
//        StatusOrder::create(['title' => 'Done']);
//        StatusOrder::create(['title' => 'Cancel']);
//
//        ProductStatus::create(['title' => 'Active']);
//        ProductStatus::create(['title' => 'Non-Active']);
//        ProductStatus::create(['title' => 'Sold-Out']);
//
//        PaymentMethod::create(['title' => 'Tunai']);
//        PaymentMethod::create(['title' => 'LinkAja']);
//        PaymentMethod::create(['title' => 'GoPay']);
//        PaymentMethod::create(['title' => 'Ovo']);
//        PaymentMethod::create(['title' => 'Dana']);
//
//        User::create([
//            'name' => 'admin',
//            'email' => 'admin@admin',
//            'password' => bcrypt('admin'),
//            'role' => 1,
//        ]);
//
//        User::create([
//            'name' => 'head-cafe',
//            'email' => 'headcafe@headcafe',
//            'password' => bcrypt('headcafe'),
//            'role' => 2,
//        ]);
//
//        User::create([
//            'name' => 'admin-stock',
//            'email' => 'adminstock@adminstock',
//            'password' => bcrypt('adminstock'),
//            'role' => 3,
//        ]);
//        User::create([
//            'name' => 'cashier',
//            'email' => 'cashier@cashier',
//            'password' => bcrypt('cashier'),
//            'role' => 4,
//        ]);

        $amounts = [
            2021=>[1944, 7830, 12988,18708,1080,1555,1873,1489,1899,1523, 1043, 3119,],
            2022=>[2543, 8989, 15038, 21804, 1304, 2281, 2831, 1930, 1966, 1513, 1371, 4157,],
            2023=>[3568, 11032, 22709, 29770, 1534, 2798, 3391, 2168, 2601, 1940, 2138, 6661,]
        ];
        $seasonal = [
            0.42375252, 1.706780985, 2.831120234, 4.07796407, 0.235418067, 0.33895842, 0.408275962, 0.324571761, 0.413943434, 0.33198307, 0.227352818, 0.679878658,
        ];

        for ($year = 2021; $year < 2024; $year++){
            for ($month = 0; $month < 12; $month++){
                $forecast = Forecast::create([
                    'year' => $year,
                    'month' => $month+1,
                    'amount' => $amounts[$year][$month]
                ]);
                if ($year==2021){
                    $forecast->update([
                        'seasonal'=>$seasonal[$month]
                    ]);
                }
                if ($month==11 && $year==2021){
                    $forecast->update([
                        'level'=>4587.583333,
                        'trend'=>98.44444444
                    ]);
                }
            }
        }


    }
}
