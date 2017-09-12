<?php

namespace App\JsonApi\Folders;


use CloudCreativity\JsonApi\Contracts\Validators\RelationshipsValidatorInterface;
use CloudCreativity\LaravelJsonApi\Validators\AbstractValidatorProvider;

class Validators extends AbstractValidatorProvider
{

    protected $allowedIncludePaths = [
        'feeds'
    ];

    protected $allowedSortParameters = [
        'order',
        'name'
    ];

    /**
     * @var string
     */
    protected $resourceType = 'folders';

    /**
     * Get the validation rules for the resource attributes.
     *
     * @param object|null $record
     *      the record being updated, or null if it is a create request.
     *
     * @return array
     */
    protected function attributeRules($record = null)
    {
        return [
            //
        ];
    }

    /**
     * Define the validation rules for the resource relationships.
     *
     * @param RelationshipsValidatorInterface $relationships
     * @param object|null                     $record
     *      the record being updated, or null if it is a create request.
     *
     * @return void
     */
    protected function relationshipRules(RelationshipsValidatorInterface $relationships, $record = null)
    {
        $allowEmpty = false;
        $required = is_null($record);

        $relationships->hasOne('user', 'users', $required, $allowEmpty);
    }

}
