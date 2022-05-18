<?php

namespace Tests\Unit;

use Illuminate\Support\MessageBag;
use Mockery;
use Tests\TestCase;
use App\Http\Controllers\CallbackController;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Request;
use App\Repositories\RoomRepositoryInterface;

class CallbackControllerTest extends TestCase
{
    /**
     * @covers CallbackController::callback
     *
     * @dataProvider callbackProvider
     *
     * @param $requestProvider
     * @param $messageBagProvider
     * @param $responseProvider
     * @return void
     */
    public function testCallback($requestProvider, $messageBagProvider, $responseProvider): void
    {
        $requestMock = Mockery::mock(Request::class);
        $roomRepositoryMock = Mockery::mock(RoomRepositoryInterface::class);
        $controller = new CallbackController();

        $messageBag = new MessageBag($messageBagProvider);

        $requestMock->expects('input')->withNoArgs()->once()->andReturn($requestProvider);

        $roomRepositoryMock->expects('createOrUpdateMany')->once()->with($requestProvider)->andReturn($messageBag);

        $response = $controller->callback($requestMock, $roomRepositoryMock);

        $this->assertEquals(Response::HTTP_OK, $response->getStatusCode());
        $this->assertEquals($responseProvider, $response->getOriginalContent());
    }

    /**
     * @return array
     */
    public function callbackProvider(): array
    {
        return [
            [
                'request' => [
                    [
                        "external_id" => "two-person-room",
                        "vendor" => "PMS1",
                        "name" => "Spacious two-person meeting room",
                        "size" => 2,
                        "amenities" => ["Tea and Coffee", "TV"],
                        "hourly_rate" => 100,
                        "daily_rate" => 500,
                        "photo" => "base64-encoded-image",
                    ],
                    [
                        "external_id" => "four-person-room",
                        "vendor" => "PMS1",
                        "name" => "Four-person meeting room",
                        "size" => 4,
                        "amenities" => ["Tea and Coffee", "TV", "Whiteboard", "Phone"],
                        "hourly_rate" => 200,
                        "daily_rate" => 800,
                        "photo" => "base64-encoded-image",
                    ],
                    [
                        "external_id" => "six-person-room",
                        "vendor" => "PMS1",
                        "name" => "Six-person room",
                        "size" => 6,
                        "amenities" => ["Tea and Coffee", "TV", "Phone"],
                        "hourly_rate" => 300,
                        "daily_rate" => null,
                        "photo" => "base64-encoded-image",
                    ]
                ],
                'messageBag' => [
                    "two-person-room" => ["Record updated."],
                    "four-person-room" => ["Record updated."],
                    "six-person-room" => ["Record updated."],
                ],
                'response' => [
                    "two-person-room" => "Record updated.",
                    "four-person-room" => "Record updated.",
                    "six-person-room" => "Record updated."
                ],
            ],
            [
                'request' => [
                    [
                        "external_id" => "81cvSy",
                        "vendor" => "PMS2",
                        "name" => "Two-person meeting room",
                        "size" => 2,
                        "amenities" => ["TV", "Conference Phone"],
                        "hourly_rate" => 150,
                        "daily_rate" => null,
                        "photo" => "base64-encoded-image",
                    ],
                    [
                        "external_id" => "Ii8f7PWJ",
                        "vendor" => "PMS2",
                        "name" => "Four-person meeting room",
                        "size" => 4,
                        "amenities" => ["Whiteboard", "Stationary", "TV"],
                        "hourly_rate" => 250,
                        "daily_rate" => null,
                        "photo" => "base64-encoded-image",
                    ],
                    [
                        "external_id" => "6ncBqW8T",
                        "vendor" => "PMS2",
                        "name" => "Six-person meeting room",
                        "size" => 6,
                        "amenities" => ["Whiteboard", "Stationary", "TV", "Conference Phone"],
                        "hourly_rate" => 300,
                        "daily_rate" => null,
                        "photo" => "base64-encoded-image",
                    ],
                ],
                'messageBag' => [
                    "81cvSy" => ["Record updated."],
                    "Ii8f7PWJ" => ["Record updated."],
                    "6ncBqW8T" => ["Record updated."],
                ],
                'response' => [
                    "81cvSy" => "Record updated.",
                    "Ii8f7PWJ" => "Record updated.",
                    "6ncBqW8T" => "Record updated."
                ],
            ],
        ];
    }
}
