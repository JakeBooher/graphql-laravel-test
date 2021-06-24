<?php

declare(strict_types=1);

namespace App\GraphQL\Types;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;

class ExampleDataType extends GraphQLType
{
    protected $attributes = [
        'name' => 'ExampleData',
        'description' => 'A type',
    ];

    public function fields(): array
    {
        return [
            'key' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'A random key that is generated by a resolver'
            ],
        ];
    }
}
