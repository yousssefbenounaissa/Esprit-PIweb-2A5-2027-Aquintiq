<?php
namespace App\Models;

class Booking extends Model
{
    protected static string $table = 'booking';
    protected static array $fillable = ['equipment_id', 'renter_id', 'start_date', 'end_date', 'status'];
}
