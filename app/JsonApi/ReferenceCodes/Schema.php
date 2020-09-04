<?php

namespace App\JsonApi\ReferenceCodes;

use Neomerx\JsonApi\Schema\SchemaProvider;

class Schema extends SchemaProvider
{

    /**
     * @var string
     */
    protected $resourceType = 'reference-codes';

    /**
     * @param \App\Models\ReferenceCode $resource
     *      the domain record being serialized.
     * @return string
     */
    public function getId($resource)
    {
        return (string) $resource->getRouteKey();
    }

    /**
     * @param \App\Models\ReferenceCode $resource
     *      the domain record being serialized.
     * @return array
     */
    public function getAttributes($resource)
    {
        return [
            'code' => $resource->code,
            'course_id' => $resource->course_id,
            'student_id' => $resource->student_id,
        ];
    }
}
