<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Type;

class CategoryTypeSeeder extends Seeder
{
    public function run()
    {
        // Define categories and their types
        $categories = [
            'أعلاف' => ['مخلفات', 'أملاح', 'فيتامينات'],
            'مركب' => ['بروتين', 'دهون'],
            'مكملات' => ['فيتامينات'],
            'الدواء' => ['مسكنات', 'مضادات'],
            'ماء' => ['حصى', 'طارد رمل'],
            'أنتخاب' => ['مواد فاعلة']
        ];

        // Insert categories and types
        foreach ($categories as $categoryName => $types) {
            $category = Category::create(['name' => $categoryName]);

            foreach ($types as $typeName) {
                Type::create(['name' => $typeName, 'category_id' => $category->id]);
            }
        }
    }
}
