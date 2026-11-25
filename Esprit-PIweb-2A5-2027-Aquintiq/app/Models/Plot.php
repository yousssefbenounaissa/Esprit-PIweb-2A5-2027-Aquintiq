<?php
namespace App\Models;

class Plot extends Model
{
    protected static string $table = 'plot';
    protected static array $fillable = ['farm_id', 'crop_id', 'label', 'area_ha', 'soil_moisture'];
}
