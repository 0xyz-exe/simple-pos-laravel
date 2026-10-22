<?php
namespace Database\Seeders;
use App\Models\{User, Category, Product};
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::factory()->create(['name' => 'Demo User', 'email' => 'demo@example.com']);
        
        $cat1 = Category::create(['name' => 'Food & Beverage', 'description' => 'Food and drinks']);
        $cat2 = Category::create(['name' => 'Electronics', 'description' => 'Electronic goods']);
        
        Product::create(['category_id' => $cat1->id, 'name' => 'Coffee', 'sku' => 'FNB001', 'price' => 15000, 'stock' => 50]);
        Product::create(['category_id' => $cat1->id, 'name' => 'Sandwich', 'sku' => 'FNB002', 'price' => 25000, 'stock' => 30]);
        Product::create(['category_id' => $cat2->id, 'name' => 'USB Cable', 'sku' => 'ELC001', 'price' => 50000, 'stock' => 20]);
        Product::create(['category_id' => $cat2->id, 'name' => 'Power Bank', 'sku' => 'ELC002', 'price' => 150000, 'stock' => 15]);
    }
}
