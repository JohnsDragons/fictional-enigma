<?php

namespace App\Classes;

use App\Models\Discount;
use App\Models\Order;
use App\Models\Product;

class DiscountGenerator
{
    public float $subtotal;
    public array $discounts;
    public float $total;
    public function __construct(Order $order)
    {


        $this->subtotal = $this->total = $order->getSubtotal();
        $this->discounts = [];

        foreach (Discount::all() as $discount) {
            if ($discount->passesForOrder($order)) {
                $discountValue = $discount->getDiscountedValueFromTotal($this->total);
                $this->discounts[] = [
                    'name' => $discount->name,
                    'amount' => $discountValue
                ];

                $this->total -= $discountValue;
            }
        }
    }
}
