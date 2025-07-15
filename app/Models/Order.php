<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['customer_id'];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'order_product', 'order_id', 'product_id')->withPivot('quantity');
    }

    public function getSubtotal()
    {
        $subtotal = 0;

        $this->products->each(function ($product) use (&$subtotal) {
            $subtotal += $product->price_in_cents * $product->pivot->quantity;
        });

        return round($subtotal / 100, 2);
    }

    public function getTotal()
    {
        $total = $this->getSubtotal();

        foreach (Discount::all() as $discount) {
            if ($discount->passesForOrder($this)) {
                $total -= $discount->getDiscountedValueFromTotal($total);
            }
        }

        return $total;
    }
}
