<?php
namespace App\Models;

class Enrollment extends Model
{
    protected static string $table = 'enrollment';
    protected static array $fillable = ['course_id', 'user_id', 'status', 'enrolled_at'];
}
