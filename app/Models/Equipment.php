<?php
namespace App\Models;

class Equipment extends Model
{
    protected static string $table = 'equipment';
    protected static array $fillable = ['owner_id', 'name', 'type', 'daily_rate_dt', 'status'];
}
