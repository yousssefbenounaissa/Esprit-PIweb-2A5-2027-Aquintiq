<?php
namespace App\Models;

class User extends Model
{
    protected static string $table = 'user';
    protected static array $fillable = ['role_id', 'name', 'email', 'password_hash', 'phone', 'photo'];
}
