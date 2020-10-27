<?php

namespace App\JsonApi\Students;

use CloudCreativity\LaravelJsonApi\Validation\AbstractValidators;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

class Validators extends AbstractValidators
{

    /**
     * The include paths a client is allowed to request.
     *
     * @var string[]|null
     *      the allowed paths, an empty array for none allowed, or null to allow all paths.
     */
    protected $allowedIncludePaths = [];

    /**
     * The sort field names a client is allowed send.
     *
     * @var string[]|null
     *      the allowed fields, an empty array for none allowed, or null to allow all fields.
     */
    protected $allowedSortParameters = ['id'];

    /**
     * The filters a client is allowed send.
     *
     * @var string[]|null
     *      the allowed filters, an empty array for none allowed, or null to allow all.
     */
    protected $allowedFilteringParameters = ['search'];

    /**
     * Get resource validation rules.
     *
     * @param mixed|null $record
     *      the record being updated, or null if creating a resource.
     * @return mixed
     */
    protected function rules($record = null): array
    {
        return [
            'name' => 'required',
            'last_name' => 'required',
            'identification' => 'required',
            'email' => ['required', 'email', Rule::unique('students')->ignore($record)],
            'phone' => 'required',
            'city' => 'required|string',
            'state' => 'required|string',
            'country' => 'required|string',
            'status' => 'required|string',
            'thinkific_user_id' => 'integer|nullable',
        ];
    }

    /**
     * Get query parameter validation rules.
     *
     * @return array
     */
    protected function queryRules(): array
    {
        return [
            //
        ];
    }

}
