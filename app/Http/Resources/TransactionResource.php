<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TransactionResource extends JsonResource
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
            'type' => 'transactions',
            'id' => (string) $this->resource->getRouteKey(),
            'attributes' => [
                'type' => $this->resource->type,
                'status_detail' => $this->resource->status_detail,
                'payment_method_id' => $this->resource->payment_method_id,
                'status' => $this->resource->status,
                'external_reference' => $this->resource->external_reference,
            ],
            'links' => [
                'self' => route('transactions.show', $this->resource)
            ]
        ];
    }
}
