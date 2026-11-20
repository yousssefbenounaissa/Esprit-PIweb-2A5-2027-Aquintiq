<?php
namespace App\Models;

class PlantingPlan extends Model
{
    protected static string $table = 'planting_plan';
    protected static array $fillable = ['farm_id', 'crop_id', 'season', 'start_date', 'end_date'];
}
