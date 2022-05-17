<?php

namespace App\Repositories;

use App\Models\Room;
use Illuminate\Contracts\Support\MessageBag;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;

interface RoomRepositoryInterface
{
    /**
     * @param array $rooms
     * @return MessageBag
     */
    public function createOrUpdateMany(array $rooms): MessageBag;

    /**
     * @return Collection
     */
    public function getAll(): Collection;

    /**
     * @param string $externalId
     * @return Room
     *
     * @throws ModelNotFoundException
     */
    public function getRoomByExternalId(string $externalId): Room;
}
