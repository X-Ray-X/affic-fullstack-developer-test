<?php

namespace App\Transformers;

use App\Models\Room;
use League\Fractal\TransformerAbstract;

class RoomTransformer extends TransformerAbstract
{
    /**
     * @param Room $room
     * @return array
     */
    public function transform(Room $room): array
    {
        return [
            'id' => $room->external_id,
            'name' => $room->name,
            'size' => $room->size,
            'amenities' => $room->amenities,
            'hourlyRate' => $room->hourly_rate,
            'dailyRate' => $room->daily_rate,
            'photo' => $room->photo,
        ];
    }
}
