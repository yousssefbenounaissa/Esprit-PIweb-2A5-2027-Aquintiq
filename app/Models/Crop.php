<?php
namespace App\Models;

class Crop extends Model
{
    protected static string $table = 'crop';
    protected static array $fillable = ['name', 'water_need_mm'];
}
