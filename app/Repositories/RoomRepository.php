<?php

namespace App\Repositories;

use App\Models\Room;
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
                    'photo' => $room['photo'],
                ]);

                $report->add($room['external_id'], "Record updated: " . ($result ? 'true' : 'false'));

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
                'photo' => $room['photo'],
            ]);

            $report->add($room['external_id'], "Record created: " . ($result ? 'true' : 'false'));
        }

        return $report;
    }
}
