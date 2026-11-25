<?php
namespace App\Models;

class ContactMessage extends Model
{
    protected static string $table = 'contact_message';
    protected static array $fillable = ['name', 'email', 'subject', 'message'];
}
