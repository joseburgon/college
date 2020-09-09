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
            'payment_type' => $transaction->type,
            'status_detail' => $transaction->status_detail,
            'payment_method_id' => $transaction->payment_method_id,
            'status' => $transaction->status,
            'external_reference' => $transaction->external_reference,
            'description' => $transaction->description
        ];
    }

    public function getRelationships($transaction, $isPrimary, array $includeRelationships)
    {
        return [
            'reference-codes' => [
                self::SHOW_RELATED => true,
                self::SHOW_SELF => true,
                self::SHOW_DATA => isset($includeRelationships['reference-codes']),
                self::DATA => function() use ($transaction) {
                    return $transaction->referenceCode;
                }
            ]
        ];
    }
}
