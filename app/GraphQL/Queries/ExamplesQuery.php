<?php

declare(strict_types=1);

namespace App\GraphQL\Queries;

use App\Models\Example;
use Closure;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\SelectFields;

class ExamplesQuery extends Query
{
    protected $attributes = [
        'name' => 'example',
        'description' => 'A query'
    ];

    public function type(): Type
    {
        return Type::listOf(\GraphQL::type('Example'));
    }

    public function args(): array
    {
        return [];
    }

    public function resolve($root, $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        /** @var SelectFields $fields */
        $fields = $getSelectFields();
        $select = $fields->getSelect();
        $with = $fields->getRelations();

        $root = Example::with($with);

        return $root->get();
    }
}
