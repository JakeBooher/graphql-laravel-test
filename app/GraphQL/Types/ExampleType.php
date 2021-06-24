<?php

declare(strict_types=1);

namespace App\GraphQL\Types;

use App\Models\Example;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;

class ExampleType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Example',
        'description' => 'A type',
        'model' => Example::class,
    ];

    public function fields(): array
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::id()),
                'description' => 'Example\'s ID',
            ],
            'name' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Example\'s name',
            ],
            'exampleRelations' => [
                'type' => Type::listOf(\GraphQL::type('ExampleRelation')),
            ],
            'data' => [
                'type' => \GraphQL::type('ExampleData'),
                'description' => 'Some data for the Example',
            ],
            'data_not_selectable' => [
                'type' => \GraphQL::type('ExampleData'),
                'selectable' => false,
                'description' => 'Some more data for the Example, but with \'selectable\' => \'false\'.',
            ],
        ];
    }
}
