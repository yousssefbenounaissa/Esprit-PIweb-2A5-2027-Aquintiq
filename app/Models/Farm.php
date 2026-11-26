<?php
namespace App\Models;

class Farm extends Model
{
    protected static string $table = 'farm';
    protected static array $fillable = ['owner_id', 'technician_id', 'name', 'region', 'area_ha'];
}
