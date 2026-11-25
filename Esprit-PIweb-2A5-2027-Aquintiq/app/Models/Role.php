<?php
namespace App\Models;

class Role extends Model
{
    protected static string $table = 'role';
    protected static array $fillable = ['name'];
}
