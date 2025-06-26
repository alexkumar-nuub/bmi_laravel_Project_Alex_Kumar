<?php
namespace Database\Factories;

use App\Models\BmiRecord;
use Illuminate\Database\Eloquent\Factories\Factory;

class BmiRecordFactory extends Factory
{
    protected $model = BmiRecord::class;  // Corrected this line

    public function definition()
    {
        $weight = $this->faker->randomFloat(1, 40, 150);
        $height = $this->faker->randomFloat(1, 140, 200);
        $bmi = $weight / (($height/100) ** 2);

        return [
            'name' => $this->faker->name,
            'weight' => $weight,
            'height' => $height,
            'bmi_value' => $bmi,
            'category' => $this->getCategory($bmi),
        ];
    }

    private function getCategory($bmi)
    {
        if ($bmi < 18.5) return 'Underweight';
        if ($bmi < 25) return 'Normal weight';
        if ($bmi < 30) return 'Overweight';
        return 'Obesity';
    }
}