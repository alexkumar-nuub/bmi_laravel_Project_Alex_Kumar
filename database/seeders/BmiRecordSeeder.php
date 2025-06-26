<?php
namespace Database\Seeders;

use App\Models\BmiRecord;
use Illuminate\Database\Seeder;

class BmiRecordSeeder extends Seeder
{
    // public function run()
    // {
    //     // Correct way to use the factory
    //     BmiRecord::factory()->count(10)->create();
    // }

    // database/seeders/BmiRecordSeeder.php
    public function run()
    {
        $categories = ['Underweight', 'Normal weight', 'Overweight', 'Obesity'];

        for ($i = 0; $i < 10; $i++) {
            $name = fake()->name;
            $weight = rand(45, 120);
            $height = rand(150, 200);
            $heightUnit = rand(0, 1) ? 'cm' : 'ft';
            $heightInCm = $heightUnit === 'ft' ? $height * 30.48 : $height;
            $heightInMeters = $heightInCm / 100;
            $bmi = $weight / ($heightInMeters * $heightInMeters);

            $categoryIndex = match (true) {
                $bmi < 18.5 => 0,
                $bmi < 25 => 1,
                $bmi < 30 => 2,
                default => 3
            };

            BmiRecord::create([
                'name' => $name,
                'weight' => $weight,
                'height' => $heightInCm,
                'height_unit' => $heightUnit,
                'bmi_value' => $bmi,
                'category' => $categories[$categoryIndex],
                'created_at' => now()->subDays(rand(0, 30))
            ]);
        }
    }
}
