<?php
namespace App\Models;

class Product extends Model
{
    protected static string $table = 'product';
    protected static array $fillable = ['seller_id', 'name', 'price_dt', 'stock', 'status'];
}
