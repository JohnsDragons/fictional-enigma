<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    public function passesForOrder(Order $order): bool
    {
        switch ($this->type) {
            case 'above_subtotal':
                return $order->getSubtotal() > $this->threshold;
            case 'after_number_of_orders':
                return $order->customer->orders()->count() > $this->threshold;
            case 'special_day':
                return SpecialDay::where('date', Carbon::now()->toDateString())->exists();
        }
    }

    public function getDiscountedValueFromTotal(float $total): float
    {
        if ($this->fixed_amount > 0) {
            return $this->fixed_amount;
        }

        return round($total * ($this->percentage_amount / 100), 2);
    }
}
