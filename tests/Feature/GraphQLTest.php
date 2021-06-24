<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GraphQLTest extends TestCase
{
    use RefreshDatabase;

    protected $seed = true;

    public function testBaseExamplesQuery()
    {
        $data = $this->httpGraphql(<<<QUERY
query ExampleQuery {
  examples {
    id
    name
  }
}
QUERY);
        $this->assertNotEmpty($data['data']['examples'][0]['id']??null);
    }

    public function testExamplesQueryWIthRelation()
    {
        $data = $this->httpGraphql(<<<QUERY
query ExampleQuery {
  examples {
    id
    name
    exampleRelations {
      id
      example_id
      name
    }
  }
}
QUERY, ['httpStatusCode' => 200]);

        $this->assertNotEmpty($data['data']['examples'][0]['exampleRelations'][0]['id']??null);
    }

    public function testExamplesQueryWithDataNotSelectable()
    {
        $data = $this->httpGraphql(<<<QUERY
query ExampleQuery {
  examples {
    id
    name
    data_not_selectable {
      key
    }
  }
}
QUERY, ['httpStatusCode' => 200]);

        $this->assertNotEmpty($data['data']['examples'][0]['data_not_selectable']['key']??null);
    }

    public function testExamplesQueryWithDataSelectable()
    {
        $data = $this->httpGraphql(<<<QUERY
query ExampleQuery {
  examples {
    id
    name
    data {
      key
    }
  }
}
QUERY);

        $this->assertNotEmpty($data['data']['examples'][0]['data']['key']??null);
    }
}
