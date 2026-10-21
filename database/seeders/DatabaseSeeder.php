<?php
namespace Database\Seeders;
use App\Models\{Category, Product, User};
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
class DatabaseSeeder extends Seeder {
    public function run(): void {
        User::updateOrCreate(['email' => 'admin@bartwel.com'], [
            'name' => 'Admin', 'password' => Hash::make('password'), 'role' => 'admin',
        ]);
        $cats = [];
        foreach (['Football' => 'football', 'Gym' => 'gym', 'Running' => 'running', 'Nutrition' => 'nutrition'] as $name => $slug) {
            $cats[$slug] = Category::firstOrCreate(['slug' => $slug], ['name' => $name]);
        }
        $items = [
            ['football', 'Pro Match Football Boots', 850, 20], ['football', 'Training Football Size 5', 250, 40],
            ['gym', 'Adjustable Dumbbell Set', 1200, 10], ['gym', 'Yoga Mat', 180, 35],
            ['running', 'Road Runner Shoes', 720, 25], ['running', 'Running Shorts', 150, 50],
            ['nutrition', 'Whey Protein 2kg', 980, 15], ['nutrition', 'Shaker Bottle', 90, 60],
        ];
        foreach ($items as [$slug, $name, $price, $stock]) {
            Product::firstOrCreate(['name' => $name], [
                'category_id' => $cats[$slug]->id, 'price' => $price, 'stock' => $stock,
                'description' => $name . ' for athletes and fitness lovers.',
            ]);
        }
    }
}
