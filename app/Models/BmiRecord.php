<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BmiRecord extends Model
{
    use HasFactory;  // Add this trait

    protected $fillable = [
        'name',
        'weight',
        'height',
        'height_unit',
        'bmi_value',
        'category'
    ];

}