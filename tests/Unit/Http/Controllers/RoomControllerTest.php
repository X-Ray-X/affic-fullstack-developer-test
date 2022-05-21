<?php

namespace Tests\Unit\Http\Controllers;

use App\Http\Controllers\RoomController;
use App\Models\Room;
use App\Repositories\RoomRepositoryInterface;
use App\Transformers\RoomIndexTransformer;
use App\Transformers\RoomTransformer;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Mockery;
use Mockery\LegacyMockInterface;
use Tests\TestCase;
use Symfony\Component\HttpFoundation\Response;

class RoomControllerTest extends TestCase
{
    private RoomRepositoryInterface|LegacyMockInterface $roomRepositoryMock;
    private RoomController $controller;

    public function setUp(): void
    {
        parent::setUp();

        $this->roomRepositoryMock = Mockery::mock(RoomRepositoryInterface::class);
        $this->controller = new RoomController($this->roomRepositoryMock);
    }

    /**
     * @covers RoomController::index
     *
     * @return void
     */
    public function testIndex(): void
    {
        $roomCollection = new Collection([
            new Room([
                'id' => 1,
                'external_id' => 'two-person-room',
                'name' => 'Spacious two-person meeting room',
                'size' => 2,
                'amenities' => ["Tea and Coffee", "TV"],
                'hourly_rate' => 100,
                'daily_rate' => 500,
                'photo' => 'path/to/image.jpeg',
            ]),
            new Room([
                'id' => 2,
                'external_id' => 'six-person-room',
                'name' => 'Six-person room',
                'size' => 6,
                'amenities' => ["Tea and Coffee", "TV", "Phone"],
                'hourly_rate' => 300,
                'daily_rate' => null,
                'photo' => 'path/to/image.jpeg',
            ])
        ]);

        $this->roomRepositoryMock->expects('getAll')->once()->withNoArgs()->andReturn($roomCollection);

        $response = $this->controller->index();

        $this->assertEquals(Response::HTTP_OK, $response->getStatusCode());
        $this->assertEquals(
            (new RoomIndexTransformer())
                ->transform($roomCollection)
                ->paginate(5)
                ->jsonSerialize(),
            $response->getOriginalContent());
    }

    /**
     * @covers RoomController::get
     *
     * @return void
     */
    public function testGet(): void
    {
        $externalId = 'two-person-room';

        $room = new Room([
            'id' => 1,
            'external_id' => 'two-person-room',
            'name' => 'Spacious two-person meeting room',
            'size' => 2,
            'amenities' => ["Tea and Coffee", "TV"],
            'hourly_rate' => 100,
            'daily_rate' => 500,
            'photo' => 'path/to/image.jpeg',
        ]);

        $this->roomRepositoryMock->expects('getRoomByExternalId')->once()->with($externalId)->andReturn($room);

        $response = $this->controller->get($externalId);

        $this->assertEquals(Response::HTTP_OK, $response->getStatusCode());
        $this->assertEquals((new RoomTransformer())->transform($room), $response->getOriginalContent());
    }

    /**
     * @covers RoomController::get
     *
     * @return void
     */
    public function testGetRoomNotFound(): void
    {
        $externalId = 'two-person-room';

        $this->roomRepositoryMock->expects('getRoomByExternalId')->once()->with($externalId)->andThrows(ModelNotFoundException::class);

        $response = $this->controller->get($externalId);

        $this->assertEquals(Response::HTTP_NOT_FOUND, $response->getStatusCode());
        $this->assertEquals(['error' => sprintf('A room with ID: %s does not exist in the database.', $externalId)], $response->getOriginalContent());
    }
}
