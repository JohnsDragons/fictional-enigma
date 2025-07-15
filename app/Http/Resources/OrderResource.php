<?php

namespace App\Http\Resources;

use App\Classes\DiscountGenerator;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $products = $this->products->map(function (Product $product) {
            return [
                'name' => $product->name,
                'price' => $product->price_in_cents / 100,
                'quantity' => $product->pivot->quantity,
            ];
        });

        $discountGenerator = new DiscountGenerator($this->resource);

        return [
            'order_id' => $this->id,
            'products' => $products,
            'subtotal' => $discountGenerator->subtotal,
            'discounts' => $discountGenerator->discounts,
            'total' => round($discountGenerator->total, 2)
        ];
    }
}
