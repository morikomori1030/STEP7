<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Product;
use App\Models\Sale;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        Company::factory(5)->create();
        Product::factory(30)->create();

        // 1商品あたり 1〜10 件くらいの売上レコードを作る
        Product::all()->each(function ($p) {
            Sale::factory(random_int(1, 10))->create(['product_id' => $p->id]);
        });
    }
}
