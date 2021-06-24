<?php

declare(strict_types=1);

namespace App\GraphQL\Types;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;

class ExampleRelationType extends GraphQLType
{
    protected $attributes = [
        'name' => 'ExampleRelation',
        'description' => 'A type'
    ];

    public function fields(): array
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::id()),
                'description' => 'ID of the ExampleRelation',
            ],
            'example_id' => [
                'type' => Type::nonNull(Type::id()),
                'description' => 'ID of the associated example.',
            ],
            'name' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'A random name.',
            ],
        ];
    }
}
