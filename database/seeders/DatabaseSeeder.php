<?php

namespace Database\Seeders;

use App\Models\items\ItemsCategoriesModel;
use App\Models\items\ItemsModel;
use App\Models\tables\TablesModel;
use App\Models\tables\TablesPlacesModel;
use App\Models\users\UserModel;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        UserModel::query()->updateOrCreate(
            [

                'email' => 'admin@cafe.com',
            ],
            [
                'name' => 'Super Admin',
                'email' => 'admin@cafe.com',
                "password" => Hash::make("123"),
            ]);
        $this->seedTables();
        $this->seedItems();
    }

    private function seedTables(): void
    {
        for ($i = 0; $i < 2; $i++) {
            $place = TablesPlacesModel::query()
                ->create([
                    "name" => "Place " . $i,
                ]);
            for ($t = 1; $t < 10; $t++) {
                TablesModel::query()
                    ->updateOrCreate([
                        "table_number" => $t,
                        "table_place_id" => $place->id,
                    ]);
            }
        }


    }

    private function seedItems(): void
    {

        // Create 5 categories
        for ($c = 1; $c <= 5; $c++) {
            $category = ItemsCategoriesModel::query()->create([
                'name' => "Category $c",
            ]);

            // Create 20 items per category
            for ($i = 1; $i <= 20; $i++) {
                ItemsModel::query()->create([
                    'name' => "Item $i in {$category->name}",
                    'description' => "Sample description for Item $i in {$category->name}",
                    'price' => rand(10, 200), // random price between 10 and 200
                    'category_id' => $category->id,
                    'is_active' => true,
                    'image' => null, // optional
                ]);
            }
        }
    }
}
