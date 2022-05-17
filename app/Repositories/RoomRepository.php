<?php

namespace App\Repositories;

use App\Helpers\StorageHelper;
use App\Models\Room;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\MessageBag;

class RoomRepository implements RoomRepositoryInterface
{
    /**
     * @param array $rooms
     * @return MessageBag
     */
    public function createOrUpdateMany(array $rooms): MessageBag
    {
        $report = new MessageBag();

        foreach ($rooms as $room) {
            $model = Room::where('external_id', $room['external_id'])->first();

            if (!is_null($model)) {
                $result = $model->update([
                    'vendor' => $room['vendor'],
                    'name' => $room['name'],
                    'size' => $room['size'],
                    'amenities' => $room['amenities'],
                    'hourly_rate' => $room['hourly_rate'],
                    'daily_rate' => $room['daily_rate'],
                    'photo' => StorageHelper::saveBase64Image($room['photo'], $room['external_id']),
                ]);

                $report->add($room['external_id'], ($result ? 'Record updated.' : 'Record update failed.'));

                continue;
            }

            $result = Room::create([
                'external_id' => $room['external_id'],
                'vendor' => $room['vendor'],
                'name' => $room['name'],
                'size' => $room['size'],
                'amenities' => $room['amenities'],
                'hourly_rate' => $room['hourly_rate'],
                'daily_rate' => $room['daily_rate'],
                'photo' => StorageHelper::saveBase64Image($room['photo'], $room['external_id']),
            ]);

            $report->add($room['external_id'], $result ? 'Record created.' : 'Record creation failed.');
        }

        return $report;
    }

    /**
     * @return Collection
     */
    public function getAll(): Collection
    {
        return Room::all();
    }

    /**
     * @param string $externalId
     * @return Room
     *
     * @throws ModelNotFoundException
     */
    public function getRoomByExternalId(string $externalId): Room
    {
        return Room::where('external_id', $externalId)->firstOrFail();
    }
}
