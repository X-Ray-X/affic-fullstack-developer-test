<?php

namespace Tests\Unit;

use App\Http\Middleware\NormalizeRequestSchema;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class NormalizeRequestSchemaTest extends TestCase
{
    /**
     * @return void
     * @throws \Exception
     */
    public function testHandle(): void
    {
        $data = <<<'JSON'
        [
          {
            "id" : "two-person-room",
            "room" : {
              "name" : "Spacious two-person meeting room",
              "capacity" : 2,
              "amenities" : [
                "Tea and Coffee", "TV"
              ]
            },
            "prices" : {
              "daily" : 500,
              "hourly" : 100
            },
            "photo" : "base64-encoded-image"
          }
        ]
        JSON;

        $request = \Request::create('/', 'POST', [], [], [], [], $data);

        $middleware = new NormalizeRequestSchema();

        $result = $middleware->handle($request, function () {
            return 'OK';
        });

        $this->assertEquals('OK', $result);
    }

    /**
     * @return void
     * @throws \Exception
     */
    public function testHandleBadRequest(): void
    {
        $data = <<<'JSON'
        {
        }
        JSON;

        $request = \Request::create('/', 'POST', [], [], [], [], $data);

        $middleware = new NormalizeRequestSchema();

        $result = $middleware->handle($request, function () {
            return 'OK';
        });

        $this->assertEquals(Response::HTTP_BAD_REQUEST, $result->getStatusCode());
        $this->assertEquals(['error' => 'JSON schema not recognized.'], $result->getOriginalContent());
    }
}
