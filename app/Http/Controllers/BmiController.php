<?php
namespace App\Http\Controllers;

use App\Models\BmiRecord;
use Illuminate\Http\Request;

class BmiController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function calculateold(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'weight' => 'required|numeric|min:1',
            'height' => 'required|numeric|min:1'
        ]);

        $heightInMeters = $request->height / 100;
        $bmi = $request->weight / ($heightInMeters * $heightInMeters);

        $category = $this->getCategory($bmi);

        // Save record
        BmiRecord::create([
            'name' => $request->name,
            'weight' => $request->weight,
            'height' => $request->height,
            'bmi_value' => $bmi,
            'category' => $category
        ]);

        return view('result', [
            'bmi' => number_format($bmi, 1),
            'category' => $category,
            'records' => BmiRecord::latest()->take(5)->get()
        ]);
    }

    private function getCategory($bmi)
    {
        return match (true) {
            $bmi < 18.5 => 'Underweight',
            $bmi < 25 => 'Normal weight',
            $bmi < 30 => 'Overweight',
            default => 'Obesity'
        };
    }
    // app/Http/Controllers/BmiController.php
    public function calculate(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'weight' => 'required|numeric|min:1',
            'height_value' => 'required|numeric|min:1',
            'height_unit' => 'required|in:cm,ft'
        ]);

        // Convert height to cm if in feet
        $height = $request->height_value;
        $heightUnit = $request->height_unit;

        if ($heightUnit === 'ft') {
            // Convert feet to cm (1 ft = 30.48 cm)
            $height = $height * 30.48;
        }

        $heightInMeters = $height / 100;
        $bmi = $request->weight / ($heightInMeters * $heightInMeters);

        $category = $this->getCategory($bmi);

        // Save record
        BmiRecord::create([
            'name' => $request->name,
            'weight' => $request->weight,
            'height' => $height, // store in cm
            'height_unit' => $heightUnit, // store original unit
            'bmi_value' => $bmi,
            'category' => $category
        ]);

        return view('result', [
            'bmi' => number_format($bmi, 1),
            'category' => $category,
            'records' => BmiRecord::latest()->take(5)->get()
        ]);
    }
}