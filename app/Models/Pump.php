<?php
namespace App\Models;

class Pump extends Model
{
    protected static string $table = 'pump';
    protected static array $fillable = ['farm_id', 'model', 'power_w', 'mode', 'status'];
}
