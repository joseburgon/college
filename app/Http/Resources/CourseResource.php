<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CourseResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'tagline' => $this->tagline,
            'description' => $this->description,
            'price' => $this->price,
            'price_usd' => $this->price_usd,
            'discount_percentage' => $this->discount_percentage,
            'price_with_discount' => $this->getPriceWithDiscount(),
            'price_usd_with_discount' => $this->getPriceWithDiscount(true),
        ];
    }
}
