<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Http\JsonResponse;
use PHPUnit\Framework\ExpectationFailedException;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    /**
     * Helper to dispatch an HTTP GraphQL requests.
     *
     * @param array<string,mixed> $options
     *                                     Supports the following options:
     *                                     - `expectErrors` (default: false): if no errors are expected but present, let's the test fail
     *                                     - `httpStatusCode` (default: 200): the HTTP status code to expect
     *                                     - `variables` (default: null): GraphQL variables for the query
     *                                     - `schemaName` (default: null): GraphQL schema to use
     * @return array<string,mixed> GraphQL result
     */
    protected function httpGraphql(string $query, array $options = []): array
    {
        $expectedHttpStatusCode = $options['httpStatusCode'] ?? 200;
        $expectErrors = $options['expectErrors'] ?? false;
        $variables = $options['variables'] ?? null;
        $schemaName = $options['schemaName'] ?? null;

        $payload = [
            'query' => $query,
        ];

        if ($variables) {
            $payload['variables'] = $variables;
        }

        $path = '/graphql';

        if ($schemaName) {
            $path .= "/$schemaName";
        }

        /** @var JsonResponse $response */
        $response = $this->json('POST', $path, $payload);

        $httpStatusCode = $response->getStatusCode();

        if ($expectedHttpStatusCode !== $httpStatusCode) {
            $result = $response->getData(true);
            $msg = var_export($result, true) . "\n";
            self::assertSame($expectedHttpStatusCode, $httpStatusCode, $msg);
        }

        return $response->getData(true);
    }


}
