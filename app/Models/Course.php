<?php
namespace App\Models;

class Course extends Model
{
    protected static string $table = 'course';
    protected static array $fillable = ['trainer_id', 'title', 'level', 'duration_h'];
}
