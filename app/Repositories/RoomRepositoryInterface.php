<?php

namespace App\Repositories;

use Illuminate\Contracts\Support\MessageBag;

interface RoomRepositoryInterface
{
    /**
     * @param array $rooms
     * @return MessageBag
     */
    public function createOrUpdateMany(array $rooms): MessageBag;
}
