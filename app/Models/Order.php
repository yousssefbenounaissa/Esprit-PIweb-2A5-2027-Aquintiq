<?php
namespace App\Models;

class Order extends Model
{
    protected static string $table = 'shop_order';
    protected static array $fillable = ['product_id', 'buyer_id', 'quantity', 'status', 'ordered_at'];
}
