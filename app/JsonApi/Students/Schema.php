<?php

namespace App\JsonApi\Students;

use Neomerx\JsonApi\Schema\SchemaProvider;

class Schema extends SchemaProvider
{

    /**
     * @var string
     */
    protected $resourceType = 'students';

    /**
     * @param \App\Models\Student $resource
     *      the domain record being serialized.
     * @return string
     */
    public function getId($resource)
    {
        return (string) $resource->getRouteKey();
    }

    /**
     * @param \App\Models\Student $resource
     *      the domain record being serialized.
     * @return array
     */
    public function getAttributes($resource)
    {
        return [
            'name' => $resource->name,
            'last_name' => $resource->last_name,
            'email' => $resource->email,
            'identification' => $resource->identification,
            'phone' => $resource->phone,
            'city' => $resource->city,
            'state' => $resource->state,
            'country' => $resource->country,
            'status' => $resource->status,
            'thinkific_user_id' => $resource->thinkific_user_id,
        ];
    }
}
