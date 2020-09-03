<?php

namespace App\JsonApi\Transactions;

use Neomerx\JsonApi\Schema\SchemaProvider;

class Schema extends SchemaProvider
{

    /**
     * @var string
     */
    protected $resourceType = 'transactions';

    /**
     * @param \App\Models\Transaction $resource
     *      the domain record being serialized.
     * @return string
     */
    public function getId($resource)
    {
        return (string) $resource->getRouteKey();
    }

    /**
     * @param \App\Models\Transaction $transaction
     *      the domain record being serialized.
     * @return array
     */
    public function getAttributes($transaction)
    {
        return [
            'payment-type' => $transaction->type,
            'status_detail' => $transaction->status_detail,
            'payment_method_id' => $transaction->payment_method_id,
            'status' => $transaction->status,
            'external_reference' => $transaction->external_reference,
        ];
    }
}
