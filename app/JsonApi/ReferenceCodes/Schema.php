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
            'course' => $resource->course,
            'student' => $resource->student,
            'created_at' => $resource->created_at,
            'updated_at' => $resource->updated_at,
        ];
    }

    public function getRelationships($referenceCode, $isPrimary, array $includeRelationships)
    {
        return [
            'students' => [
                self::SHOW_RELATED => true,
                self::SHOW_SELF => true,
                self::SHOW_DATA => isset($includeRelationships['students']),
                self::DATA => function() use ($referenceCode) {
                    return $referenceCode->student;
                }
            ]
        ];
    }
}
