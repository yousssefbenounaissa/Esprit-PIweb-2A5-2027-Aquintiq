<?php
namespace App\Models;

class IrrigationEvent extends Model
{
    protected static string $table = 'irrigation_event';
    protected static array $fillable = ['pump_id', 'plot_id', 'started_at', 'duration_min', 'volume_l', 'trigger_type'];
}
