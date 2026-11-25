<?php
namespace App\Models;

class PlanTask extends Model
{
    protected static string $table = 'plan_task';
    protected static array $fillable = ['plan_id', 'title', 'due_date', 'done'];
}
